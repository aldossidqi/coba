<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanModel extends Model
{
    protected $fillable = [
        'id_barang','jumlah_barang_terjual', 'jumlah_uang_masuk', 'tanggal'
    ];
}
