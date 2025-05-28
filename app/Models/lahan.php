<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lahan extends Model
{
    protected $table = 'lahan'; // Nama tabel di database
    protected $fillable = [
        'lahan sawah', 'keterangan', 'gambar'
    ];
}
