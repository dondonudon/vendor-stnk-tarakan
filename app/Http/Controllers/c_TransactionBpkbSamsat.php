<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_TransactionBpkbSamsat extends Controller
{
    public function index() {
        return view('dashboard.transaction.bpkb-dari-samsat.list');
    }

    public function validasi($nopo) {
        $mst = DB::table('po_mst')
            ->select('no_po','tgl_po','id_dealer','id_samsat','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->where('no_po','=',$nopo);

        if ($mst->exists()) {
            $data['mst'] = $mst->first();
            return view('dashboard.transaction.bpkb-dari-samsat.validasi')->with('data',$data);
        } else {
            abort(404);
        }
    }

    public function checkTotalData(Request $request) {
        $trn = DB::table('po_trns')
            ->where('status_bpkb_samsat','=',0)
            ->where('no_po','=',$request->no_po)
            ->get();
        if ($trn->count() == 0) {
            return 'failed';
        } else {
            return 'success';
        }
    }

    public function daftarValidasi(Request $request) {
        $trn = DB::table('po_trns')
            ->where('no_po','=',$request->no_po)
            ->where('status_bpkb_samsat','=',0)
            ->get();

        return $trn;
    }

    public function list() {
        $data['data'] = DB::table('po_mst')
            ->select('no_po','tgl_po','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->where('status_bpkb_samsat','=',0)
            ->get();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $data = json_decode($request->data, true);
        $noPO = $data['no_po'];
        $kendaraan = $data['data'];

        try {
            DB::beginTransaction();

            foreach ($kendaraan as $k) {
                $trn = DB::table('po_trns')
                    ->where('id','=',$k['id'])
                    ->update([
                        'status_bpkb_samsat' => $k['status'],
                    ]);

                DB::table('po_bpkb_samsat')
                    ->where('id_trn','=',$k['id'])
                    ->update([
                        'status' => $k['status'],
                        'catatan' => $k['catatan'],
                    ]);
            }

            $trnKelengkapan = DB::table('po_trns')
                ->where('no_po','=',$noPO)
                ->where('status_bpkb_samsat','=',0);
            if ($trnKelengkapan->count() == 0) {
                DB::table('po_mst')
                    ->where('no_po','=',$noPO)
                    ->update([
                        'status_bpkb_samsat' => 1,
                    ]);
            }

            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }
}
