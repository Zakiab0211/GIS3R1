<?php

namespace App\Http\Controllers;
use App\Models\Irrigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Tambahkan ini untuk http api
class IrrigationController extends Controller
{
    public function Smart_Irrigation()
    {
        $postIrrigation = Irrigation::all(); // Ambil semua data dari tabel irrigation
        return view('leaflet.smartirrigation', compact('postIrrigation'));
    }
}
