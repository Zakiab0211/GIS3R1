<?php

namespace App\Http\Controllers;
//import model
use App\Models\Soil;
use App\Models\Irrigation;
use App\Models\Weather;
use App\Models\WeatherStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Tambahkan ini untuk http api
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');//comment untuk mengaktifkan midleware auth
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function Smart_Soil()
    {

        $postsoil = Soil::all(); // Mengambil semua data dari tabel soils
        return view('leaflet.smartsoil', compact('postsoil'));
        //return view('leaflet.smartsoil');
    }

    public function Smart_Irrigation()
    {
        $postIrrigation = Irrigation::all(); // Ambil semua data dari tabel irrigation
        return view('leaflet.smartirrigation', compact('postIrrigation'));
    }

    public function Smart_Weather()
    {
        $postWeather = Weather::all(); // Ambil semua data dari tabel irrigation
        return view('leaflet.smartweather', compact('postWeather'));
    }

    public function Weather_Station()
    // {
    //     // Gantilah URL berikut dengan API Gateway endpoint yang Anda buat
    //     $apiUrl = "https://pzmw0ozlwf.execute-api.us-east-1.amazonaws.com/v1/WeatherStation";
        
    //     // Ambil data dari API
    //     $response = Http::get($apiUrl);

    //     // Cek apakah request berhasil
    //     if ($response->successful()) {
    //         $postWeatherStation = $response->json(); // Ubah JSON response menjadi array
    //     } else {
    //         $postWeatherStation = []; // Kosongkan jika terjadi error
    //     }

    //     return view('leaflet.weatherstation', compact('postWeatherStation'));
    // }
    {
        // URL API Gateway
        $apiUrl = "https://pzmw0ozlwf.execute-api.us-east-1.amazonaws.com/v1/WeatherStation";
        
        // Fetch data dari API
        $response = Http::get($apiUrl);

        // Cek jika request sukses
        if ($response->successful()) {
            $data = $response->json();
            $weatherData = $data['latest_data'] ?? [];
        } else {
            $weatherData = [];
        }

        return view('leaflet.weatherstation', compact('weatherData'));
    }
}
