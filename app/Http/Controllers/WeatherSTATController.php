<?php

namespace App\Http\Controllers;
use App\Models\WeatherStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Tambahkan ini untuk http api
class WeatherSTATController extends Controller
{
    public function Weather_Station()
    {
        // URL API Gateway
        #$apiUrl = "https://pzmw0ozlwf.execute-api.us-east-1.amazonaws.com/v1/WeatherStation";

        //URL API GATEWAY KE 2
        $apiUrl = "https://9s64d42ho3.execute-api.us-east-1.amazonaws.com/prod/weatherdata";

        try {
            // Fetch data dari API dengan timeout untuk menghindari request tergantung lama
            $response = Http::timeout(10)->get($apiUrl);

            if ($response->successful()) {
                $data = $response->json();
                $weatherData = $data['latest_data'] ?? [];
            } else {
                $weatherData = [];
            }
        } catch (\Exception $e) {
            // Jika API gagal diakses, tampilkan array kosong
            $weatherData = [];
        }

        // Pastikan setiap data memiliki latitude dan longitude agar tidak error di Leaflet
        foreach ($weatherData as &$weather) {
            $weather['latitude'] = $weather['latitude'] ?? -7.4478;
            $weather['longitude'] = $weather['longitude'] ?? 112.7183;
        }

        return view('leaflet.weatherstation', compact('weatherData'));
    }

}
