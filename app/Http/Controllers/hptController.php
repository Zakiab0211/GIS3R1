<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class hptController extends Controller
{
    public function Hpt()
    {
        $postHpt = Hpt::all(); // Ambil semua data dari tabel irrigation
        return view('leaflet.hpt', compact('postHpt'));
    }
}
