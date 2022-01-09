<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCust extends Model
{
    protected $table = 'customer';
    
    // protected $primaryKey = 'id_customer';
    // public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'alamat',
        'id_kelurahan'
    ];
}
