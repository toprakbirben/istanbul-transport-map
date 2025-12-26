<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class IettController extends Controller
{
    public function buses(Request $request)
    {
        $line = $request->query('line', 'all');
        $cacheKey = 'iett_buses_' . $line;

        return Cache::remember($cacheKey, 15, function () use ($line) {

            $url = 'https://api.ibb.gov.tr/iett/FiloDurum/SeferGerceklesme.asmx';

            $soapXml = <<<XML
                <?xml version="1.0" encoding="utf-8"?>
                <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                            xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                            xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                <soap:Body>
                    <GetFiloAracKonum_json xmlns="http://tempuri.org/" />
                </soap:Body>
                </soap:Envelope>
            XML;

            $response = Http::withHeaders([
                'Content-Type' => 'text/xml; charset=utf-8',
                'SOAPAction'   => '"http://tempuri.org/GetFiloAracKonum_json"',
            ])
            ->timeout(20)
            ->send('POST', $url, ['body' => $soapXml]);

            if (!$response->successful()) {
                return Cache::get($cacheKey, []);
            }

            $xml = $response->body();

            // Match JSON embedded in SOAP (array or object)
            if (!preg_match('/(\[.*\]|\{.*\})/s', $xml, $matches)) {
                return [];
            }

            $rawData = json_decode($matches[1], true);

            if (!is_array($rawData)) {
                return [];
            }

            // Normalize keys & types
            $data = array_map(function ($bus) {
                return [
                    'id'    => $bus['KapiNo'] ?? $bus['kapino'] ?? null,
                    'line'  => $bus['HatKodu'] ?? $bus['hatkodu'] ?? null,
                    'lat'   => isset($bus['Enlem']) ? (float) $bus['Enlem']
                               : (isset($bus['enlem']) ? (float) $bus['enlem'] : null),
                    'lng'   => isset($bus['Boylam']) ? (float) $bus['Boylam']
                               : (isset($bus['boylam']) ? (float) $bus['boylam'] : null),
                    'speed' => $bus['Hiz'] ?? $bus['hiz'] ?? null,
                    'time'  => $bus['Saat'] ?? $bus['saat'] ?? null,
                ];
            }, $rawData);

            // Optional filter by line
            if ($line !== 'all') {
                $data = array_values(array_filter($data, fn($b) => $b['line'] === $line));
            }

            return $data;
        });
    }
}