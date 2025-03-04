<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soil extends Model
{
    use HasFactory;

    protected $table = 'soil'; // Nama tabel di database
    protected $fillable = [
        'conductivity', 'fosfor', 'kalium', 'latitude', 'longitude',
        'moisture', 'nitrogen', 'ph', 'temperature'
    ];
}

