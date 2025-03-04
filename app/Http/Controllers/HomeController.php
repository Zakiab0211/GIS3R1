<?php

namespace App\Http\Controllers;
//import model
use App\Models\Soil;
use App\Models\Irrigation;
use App\Models\Weather;
use Illuminate\Http\Request;

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
}
