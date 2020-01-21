<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetLatestKode extends Controller
{
    public static function kode($table,$kode) {
        $ym = date('ym');
        $dtKode = DB::table($table)
            ->select('kode_validasi')
            ->where('kode_validasi','like',$ym.$kode.'%')
            ->orderBy('kode_validasi','desc');
        if ($dtKode->exists()) {
            $result = $dtKode->first();
            $lastInc = (int) substr($result->kode_validasi,6);
            $newInc = str_pad($lastInc+1,4,'0',STR_PAD_LEFT);
            $NewKode = $ym.$kode.$newInc;
        } else {
            $inc = str_pad(1,4,'0',STR_PAD_LEFT);
            $NewKode = $ym.$kode.$inc;
        }
        return $NewKode;
    }
}
