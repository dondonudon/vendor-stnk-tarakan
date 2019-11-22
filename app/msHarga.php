<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class msHarga extends Model
{
    protected $table = 'ms_harga';
    protected $fillable = ['kode_kendaraan','harga','pnbp','pph'];
}
