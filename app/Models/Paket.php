<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'nama_paket',
        'harga',           //harga utama
        'harga_diskon',       //harga setelah diskon
        'diskon',           //diskon(%)
        'jenis',
        'outlet_id'
    ];
}
