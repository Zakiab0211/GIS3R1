<?php

namespace App\Http\Controllers;
use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Tambahkan ini untuk http api
class SWeatherController extends Controller
{
    public function Smart_Weather()
    {
        $postWeather = Weather::all(); // Ambil semua data dari tabel irrigation
        return view('leaflet.smartweather', compact('postWeather'));
    }
}
