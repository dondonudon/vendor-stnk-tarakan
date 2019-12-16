<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class c_Cetak extends Controller
{
    public function purchaseOrder($po) {
        try {
            $data['company'] = DB::table('sys_profile')->get()->keyBy('name');
            $mst = DB::table('po_mst')
                ->select(
                    'ms_dealer.nama as dealer',
                    'ms_dealer.kuitansi',
                    'total',
                    DB::raw('COUNT(po_trns.no_po) as jumlah'),
                    DB::raw('SUM(po_trns.harga_jasa) as jasa'),
                    DB::raw('SUM(po_trns.harga_notice_bbn)+SUM(po_trns.pph)+SUM(po_trns.pnbp) as notice')
                )
                ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
                ->join('po_trns','po_mst.no_po','=','po_trns.no_po')
                ->where('po_mst.no_po','=',$po)
                ->groupBy('po_trns.no_po','total','ms_dealer.nama','ms_dealer.kuitansi');
            if ($mst->exists()) {
                $data['transaksi'] = $mst->first();
                if ($data['transaksi']->kuitansi == 1) {
                    $pdf = PDF::loadView('cetak/kuitansi-1',$data)->setPaper('a5','landscape');
                    return $pdf->stream(date('Ymd').'-'.$po.'.pdf');
                } else {
                    $pdf = PDF::loadView('cetak/kuitansi-2',$data)->setPaper('a5','landscape');
                    return $pdf->stream(date('Ymd').'-'.$po.'.pdf');
                }
            } else {
                return response()->view('errors.404');
            }
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
