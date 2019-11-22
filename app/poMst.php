<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class poMst extends Model
{
    protected $table = 'po_mst';
    protected $fillable = ['no_po','tgl_po','id_dealer','id_samsat','provinsi','kota','keterangan'];
}
