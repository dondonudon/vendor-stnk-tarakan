<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_TransactionBpkbDealer extends Controller
{
    public function index() {
        return view('dashboard.transaction.bpkb-ke-dealer.list');
    }

    public function validasi($nopo) {
        $mst = DB::table('po_mst')
            ->select('no_po','tgl_po','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->where('no_po','=',$nopo);

        if ($mst->exists()) {
            $data['mst'] = $mst->first();
            return view('dashboard.transaction.bpkb-ke-dealer.validasi')->with('data',$data);
        } else {
            return abort(404);
        }
    }

    public function daftarValidasi(Request $request) {
        $trn = DB::table('po_trns')
            ->where('no_po','=',$request->no_po)
            ->where('status_bpkb_dealer','=',0)
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
            ->where('status_bpkb_dealer','=',0)
            ->get();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $noPO = $request->no_po;
        $data = $request->data;

        try {
            DB::beginTransaction();

            foreach ($data as $d) {
                DB::table('po_trns')
                    ->where('id','=',$d['id'])
                    ->update([
                        'status_bpkb_dealer' => 1
                    ]);
            }

            $trn = DB::table('po_trns')
                ->where('no_po','=',$noPO)
                ->where('status_bpkb_dealer','=',0)
                ->get();
            if ($trn->count() == 0) {
                DB::table('po_mst')
                    ->where('no_po','=',$noPO)
                    ->update([
                        'status_bpkb_dealer' => 1
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
