<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NomorTransaksiModel extends Model
{
    protected $fillable = [
        'user_id','id_transaction','status','total_harga','bukti_bayar'
    ];
}
