<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class geolocation extends Model
{
    protected $table = 'lokasi_toko';

    protected $fillable = [
        'id_barcode',
        'nama_toko',
        'alamat_toko',
        'latitude',
        'longitude',
        'accuracy'

    ];
}
