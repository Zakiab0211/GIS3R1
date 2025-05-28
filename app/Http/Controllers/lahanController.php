<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class lahanController extends Controller
{
    public function Lahan()
    {
        // $postHpt = Hpt::all(); // Ambil semua data dari tabel hpt
        // return view('leaflet.hpt', compact('postHpt'));
        return view('leaflet.lahan');
    }
}
