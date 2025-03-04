<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irrigation extends Model
{
    use HasFactory;

    protected $table = 'irrigation'; // Nama tabel di database
    protected $fillable = [
        'curah_hujan', 'liquid_volume', 'timestamp', 'longitude', 'latitude',
        'flow_rate', 'jarak'
    ];
}