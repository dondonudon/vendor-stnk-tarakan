<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class msDealer extends Model
{
    protected $table = 'ms_dealer';
    protected $fillable = ['nama','provinsi','kota','alamat','telp','pic','jatuh_tempo','harga_jasa','keterangan'];
}
