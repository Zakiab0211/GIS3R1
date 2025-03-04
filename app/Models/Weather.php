<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $table = 'weather'; // Nama tabel di database
    protected $fillable = [
        'TimeStamp', 'Humidity', 'Latitude', 'Longitude', 'Pressure', 'Rainfall', 
        'Temperature', 'UV', 'WindDirection', 'WindSpeed'
    ];
}