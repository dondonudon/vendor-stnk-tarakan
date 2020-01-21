<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Riskihajar\Terbilang\Facades\Terbilang;

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
                $data['terbilang'] = Terbilang::make($data['transaksi']->total,' rupiah');
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

    public function platDealer($Kode) {
        try {
            return DB::table('po_plat_dealer')
                ->select('wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','ms_dealer.nama as dealer','po_trns.no_po','po_trns.nama_stnk','po_plat_dealer.tgl_validasi','po_trns.no_pol','po_trns.kode_kendaraan','po_trns.no_mesin')
                ->leftJoin('po_trns', 'po_plat_dealer.id_trn', '=', 'po_trns.id')
                ->leftJoin('po_mst', 'po_trns.no_po', '=', 'po_mst.no_po')
                ->leftJoin('ms_dealer', 'po_mst.id_dealer', '=', 'ms_dealer.id')
                ->leftJoin('wilayah_provinsi', 'ms_dealer.provinsi', '=', 'wilayah_provinsi.id')
                ->leftJoin('wilayah_kota', 'ms_dealer.kota', '=', 'wilayah_kota.id')
                ->whereIn('po_plat_dealer.kode_validasi',$Kode)
                ->get();
        } catch (\Exception $ex) {
            return response()->json([$ex]);
        }
    }

    public function bpkbDealer($Kode) {
        try {
            return DB::table('po_bpkb_dealer')
                ->select('wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','ms_dealer.nama as dealer','po_trns.no_po','po_trns.nama_stnk','po_bpkb_dealer.tgl_validasi','po_trns.no_pol','po_trns.kode_kendaraan','po_trns.no_mesin')
                ->leftJoin('po_trns', 'po_bpkb_dealer.id_trn', '=', 'po_trns.id')
                ->leftJoin('po_mst', 'po_trns.no_po', '=', 'po_mst.no_po')
                ->leftJoin('ms_dealer', 'po_mst.id_dealer', '=', 'ms_dealer.id')
                ->leftJoin('wilayah_provinsi', 'ms_dealer.provinsi', '=', 'wilayah_provinsi.id')
                ->leftJoin('wilayah_kota', 'ms_dealer.kota', '=', 'wilayah_kota.id')
                ->whereIn('po_bpkb_dealer.kode_validasi',$Kode)
                ->get();
        } catch (\Exception $ex) {
            return response()->json([$ex]);
        }
    }

    public function stnkDealer($Kode) {
        try {
            return DB::table('po_stnk_dealer')
                ->select('wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','ms_dealer.nama as dealer','po_trns.no_po','po_trns.nama_stnk','po_stnk_dealer.tgl_validasi','po_trns.no_pol','po_trns.kode_kendaraan','po_trns.no_mesin')
                ->leftJoin('po_trns', 'po_stnk_dealer.id_trn', '=', 'po_trns.id')
                ->leftJoin('po_mst', 'po_trns.no_po', '=', 'po_mst.no_po')
                ->leftJoin('ms_dealer', 'po_mst.id_dealer', '=', 'ms_dealer.id')
                ->leftJoin('wilayah_provinsi', 'ms_dealer.provinsi', '=', 'wilayah_provinsi.id')
                ->leftJoin('wilayah_kota', 'ms_dealer.kota', '=', 'wilayah_kota.id')
                ->whereIn('po_stnk_dealer.kode_validasi',$Kode)
                ->get();
        } catch (\Exception $ex) {
            return response()->json([$ex]);
        }
    }

    public function cetakKuitansiValidasi($Area,$Kode) {
        $kodeValidasi = explode('_',$Kode);
        $data = [
            'no_po' => [],
            'company' => DB::table('sys_profile')->select('name','value')->get()->keyBy('name'),
            'mst' => [
                'tgl' => null,
                'wilayah' => null,
                'dealer' => null,
            ],
            'trn' => null
        ];
        try {
            switch ($Area) {
                case 'plat-dealer':
                    $data['area'] = 'plat';
                    $data['trn'] = $this->platDealer($kodeValidasi);
                    break;

                case 'bpkb-dealer':
                    $data['area'] = 'bpkb';
                    $data['trn'] = $this->bpkbDealer($kodeValidasi);
                    break;

                case 'stnk-dealer':
                    $data['area'] = 'stnk';
                    $data['trn'] = $this->stnkDealer($kodeValidasi);
                    break;

                default:
                    return view('errors.404');
                    break;
            }

            foreach ($data['trn'] as $v) {
                if (!in_array($v->no_po,$data['no_po'])) {
//                    $data['no_po'][] = $v->no_po;
                    array_push($data['no_po'],$v->no_po);
                }
            }

            if (!empty($data['no_po'])) {
                $data['mst']['tgl'] = $data['trn'][0]->tgl_validasi;
                $data['mst']['wilayah'] = $data['trn'][0]->provinsi.' - '.$data['trn'][0]->kota;
                $data['mst']['dealer'] = $data['trn'][0]->dealer;

                $pdf = PDF::loadView('cetak.kuitansi-penerimaan-dealer',$data)->setPaper('a5','landscape');
                return $pdf->stream('kuitansi-'.$Area.'-'.$Kode.'.pdf');
            } else {
                return view('errors.404');
            }
        } catch (\Exception $ex) {
//            return response()->json([$ex,$data]);
            dd($data,$ex);
        }
    }
}
