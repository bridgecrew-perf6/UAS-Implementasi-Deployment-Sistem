<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    public $incrementing = true;
    // public $timestamps = false;

    protected $fillable = [
        'id_barang',
        'nama_barang'
    ];

}