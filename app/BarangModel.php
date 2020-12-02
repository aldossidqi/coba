<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    protected $fillable = [
        'id_barang','jumlah_barang', 'jenis', 'total_dilihat', 'harga' , 'warna', 'gambar'
    ];
}
