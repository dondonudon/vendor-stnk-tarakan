<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_TransactionStnkDealer extends Controller
{
    public function index() {
        return view('dashboard.transaction.stnk-ke-dealer.list');
    }

    public function validasi($nopo) {
        $data['mst'] = DB::table('po_mst')
            ->select('no_po','tgl_po','id_dealer','id_samsat','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->where('no_po','=',$nopo)
            ->first();

        return view('dashboard.transaction.stnk-ke-dealer.validasi')->with('data',$data);
    }

    public function checkTotalData(Request $request) {
        $trn = DB::table('po_trns')
            ->where('status_stnk_dealer','=',0)
            ->where('no_po','=',$request->no_po)
            ->get();
        if ($trn->count() == 0) {
            return 'failed';
        } else {
            return 'success';
        }
    }

    public function daftarValidasi(Request $request) {
        $saved = $request->saved ?? null;
        $table = DB::table('po_trns')
            ->where([
                ['no_po','=',$request->no_po],
                ['status_stnk_dealer','=',0],
            ]);
        if ($saved !== null) {
            $table->whereNotIn('id',$saved);
        }
        return $table->get();
    }

    public function list() {
        $data['data'] = DB::table('po_mst')
            ->select('no_po','tgl_po','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->where('status_stnk_dealer','=',0)
            ->get();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $kodeValidasi = GetLatestKode::kode('po_stnk_dealer','PD');
        $data = json_decode($request->data, true);
        $noPO = $data['no_po'];
        $kendaraan = $data['data'];
        $today = date('Y-m-d');

        try {
            DB::beginTransaction();

            foreach ($kendaraan as $k) {
                $update = [
                    'status' => $k['status'],
                    'tgl_validasi' => $today,
                    'catatan' => $k['catatan'],
                ];
                if ($k['status'] == 1) {
                    $update['kode_validasi'] = $kodeValidasi;
                }
                DB::table('po_trns')
                    ->where('id','=',$k['id'])
                    ->update([
                        'status_stnk_dealer' => $k['status'],
                    ]);

                DB::table('po_stnk_dealer')
                    ->where('id_trn','=',$k['id'])
                    ->update($update);
            }

            $trnKelengkapan = DB::table('po_trns')
                ->where('no_po','=',$noPO)
                ->where('status_stnk_dealer','=',0);
            if ($trnKelengkapan->count() == 0) {
                DB::table('po_mst')
                    ->where('no_po','=',$noPO)
                    ->update([
                        'status_stnk_dealer' => 1,
                    ]);
            }

            DB::commit();
            return ['status'=>'success','kode_validasi'=>$kodeValidasi];
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function datasetKuitansi() {
        try {
            return DB::table('po_stnk_dealer')
                ->distinct()
                ->select('po_stnk_dealer.kode_validasi', 'po_stnk_dealer.tgl_validasi', 'po_stnk_dealer.no_po', 'ms_dealer.nama as dealer')
                ->leftJoin('po_mst', 'po_stnk_dealer.no_po','=','po_mst.no_po')
                ->leftJoin('ms_dealer', 'po_mst.id_dealer', '=', 'ms_dealer.id')
                ->whereNotNull('po_stnk_dealer.kode_validasi')
                ->paginate(10);
        } catch (\Exception $ex) {
            return response()->json([$ex]);
        }
    }

    public function historyKuitansi(Request $request) {
        return view('dashboard.transaction.stnk-ke-dealer.kuitansi');
    }
}
