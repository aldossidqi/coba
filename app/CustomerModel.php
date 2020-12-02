<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $fillable = [
        'user_id','nama_customer','alamat', 'email', 'no_hp'
    ];
}
