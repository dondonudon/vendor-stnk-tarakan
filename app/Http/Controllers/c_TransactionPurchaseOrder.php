<?php

namespace App\Http\Controllers;

use App\msDealer;
use App\msHarga;
use App\msKendaraan;
use App\msSamsat;
use App\poMst;
use App\poTrn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_TransactionPurchaseOrder extends Controller
{
    public function index() {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $data = DB::table('po_mst')
            ->select('no_po','tgl_po','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->where('no_po','like','%'.$search.'%')
            ->orderBy('created_at','desc')
            ->paginate(10);
        return view(
            'dashboard.transaction.purchase-order.list',
            [
                'purchaseorder' => $data,
                'search' => $search
            ]);
    }

    public function add() {
        $dealer = msDealer::all()->keyBy('id')->toArray();
        $samsat = msSamsat::all()->toArray();
        $kendaraan = msKendaraan::all()->keyBy('kode')->toArray();
        $harga = msHarga::all()->keyBy('kode_kendaraan')->toArray();
        $data = [
            'dealer' => $dealer,
            'samsat' => $samsat,
            'kendaraan' => $kendaraan,
            'harga' => $harga,
        ];
        return view('dashboard.transaction.purchase-order.baru')->with('data',$data);
    }

    public function validasi(Request $request) {
        $area = $request->area;
        $text = $request->text;
        $result = '';

        switch ($area) {
            case 'no_po':
                $data = DB::table('po_mst')->where('no_po','=',$text);
                if ($data->exists()) {
                    $result = 'not available';
                } else {
                    $result = 'available';
                }
                break;
        }
        return $result;
    }

    public function edit($id) {
        $data = DB::table('ms_dealer')->where('id','=',$id)->first();
        return view('dashboard.transaction.purchase-order.edit')->with('data',$data);
    }

//    public function list() {
//        $data['data'] = DB::table('po_mst')
//            ->select('no_po','tgl_po','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
//            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
//            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
//            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
//            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
//            ->join('users','po_mst.id_user','=','users.id')
//            ->paginate(10);
//        return json_encode($data);
//    }

    public function submit(Request $request) {
        $idUser = 3;
        $data = json_decode($request->data,true);

        try {
            DB::beginTransaction();

            $mst = new poMst();
            $mst->no_po = $data['mst']['no_po'];
            $mst->tgl_po = date('Y-m-d',strtotime($data['mst']['tgl_po']));
            $mst->id_dealer = $data['mst']['dealer'];
            $mst->id_samsat = $data['mst']['samsat'];
            $mst->provinsi = $data['mst']['provinsi'];
            $mst->kota = $data['mst']['kota'];
            $mst->id_user = $idUser;
            $mst->keterangan = $data['mst']['keterangan'];
            $mst->save();

            foreach ($data['trn'] as $t) {
                $trn = new poTrn();
                $trn->no_po = $data['mst']['no_po'];
                $trn->kode_kendaraan = $t['kode_kendaraan'];
                $trn->no_mesin = $t['no_mesin'];
                $trn->nama_stnk = $t['nama_stnk'];
                $trn->keterangan = '';
                $trn->save();
            }

            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($data,$ex);
        }
    }

    public function detail($nopo) {
        $mst = DB::table('po_mst')
            ->select('no_po','tgl_po','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->where('no_po','=',$nopo)
            ->first();

        $data = [
            'mst' => $mst,
        ];
        return view('dashboard.transaction.purchase-order.detail')->with('data',$data);
    }

    public function daftarKendaraan(Request $request) {
        $trn = DB::table('po_trns')
            ->where('no_po','=',$request->no_po)
            ->get();

        return $trn;
    }
}