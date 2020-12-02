<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanBMModel extends Model
{
    protected $fillable = [
        'jumlah_barang_masuk','tanggal_masuk', 'status'
    ];
}
