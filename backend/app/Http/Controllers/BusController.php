<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BusController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.example.com/bus-locations');

        if (!$response->successful()) {
            return response()->json([], 500);
        }

        return response()->json(
            $response->json()
        );
    }
}