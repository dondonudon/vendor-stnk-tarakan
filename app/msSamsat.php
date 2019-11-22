<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class msSamsat extends Model
{
    protected $table = 'ms_samsat';
    protected $fillable = ['nama','provinsi','kota','alamat'];
}
