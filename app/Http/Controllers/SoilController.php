<?php

namespace App\Http\Controllers;
use App\Models\Soil;
use Illuminate\Http\Request;

class SoilController extends Controller
{
    public function Smart_Soil()
    {

        $postsoil = Soil::all(); // Mengambil semua data dari tabel soils
        return view('leaflet.smartsoil', compact('postsoil'));
        //return view('leaflet.smartsoil');
    }
}
