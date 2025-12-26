<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IettController;

Route::middleware('throttle:30,1')->get(
    '/iett/buses',
    [IettController::class, 'buses']
);

Route::get('/routes/bus', function () {
    $file = storage_path('app/routes/istanbul_bus_routes.geojson');

    if (!file_exists($file)) {
        return response()->json(['error' => 'Routes not found'], 404);
    }
    return response()->file($file, [
        'Content-Type' => 'application/json'
    ]);
});