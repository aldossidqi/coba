<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $fillable = [
        'user_id','transaction_id','nama_customer','alamat', 'email', 'no_hp', 'barang_id','harga','jumlah_dibeli','warna','jenis','status','keranjang','tanggal_beli', 'total_harga'
    ];
}
