<?php

namespace App\Http\Controllers;

use App\msHarga;
use App\poMst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_TransactionValidateNotice extends Controller
{
    public function index() {
        return view('dashboard.transaction.validasi-notice.list');
    }

    public function add() {
        return view('dashboard.transaction.validasi-notice.baru');
    }

    public function validasi($nopo) {
        $data['mst'] = DB::table('po_mst')
            ->select('no_po','tgl_po','po_mst.id_dealer as id_dealer','po_mst.id_samsat as id_samsat','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->where('no_po','=',$nopo)
            ->first();

        return view('dashboard.transaction.validasi-notice.validasi')->with('data',$data);
    }

    public function checkTotalData(Request $request) {
        $trn = DB::table('po_trns')
            ->where('status_bbn_proses','=',0)
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
            ->where('status_bbn_proses','=',0);
        if (isset($request->saved)) {
            $result = $trn
                ->whereNotIn('id',json_decode($request->saved,true))
                ->get();
        } else {
            $result = $trn->get();
        }
        return $result;
    }

    public function list() {
        $data['data'] = DB::table('po_mst')
            ->select('no_po','tgl_po','ms_dealer.nama as dealer','ms_samsat.nama as samsat','wilayah_provinsi.name as provinsi','wilayah_kota.name as kota','total','users.name as user','po_mst.keterangan','po_mst.created_at')
            ->join('ms_dealer','po_mst.id_dealer','=','ms_dealer.id')
            ->join('ms_samsat','po_mst.id_samsat','=','ms_samsat.id')
            ->join('wilayah_provinsi','po_mst.provinsi','=','wilayah_provinsi.id')
            ->join('wilayah_kota','po_mst.kota','=','wilayah_kota.id')
            ->join('users','po_mst.id_user','=','users.id')
            ->where('status_notice','=',0)
            ->get();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $data = json_decode($request->data, true);
        $noPO = $data['no_po'];
        $kendaraan = $data['data'];
        $jasa = DB::table('ms_dealer')->select('harga_jasa')->where('id','=',$data['id_dealer'])->first();
        $harga = msHarga::all()->keyBy('kode_kendaraan');

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($kendaraan as $k) {
                $hargaJasa = $jasa->harga_jasa;
                $hargaNotice = $harga[$k['tipe_kendaraan']]->harga;
                $pph = $harga[$k['tipe_kendaraan']]->pph;
                $pnbp = $harga[$k['tipe_kendaraan']]->pnbp;
                $subtotal = ($hargaJasa+$hargaNotice+$pnbp)-$pph;
                $total += $subtotal;
                $trn = DB::table('po_trns')
                    ->where('id','=',$k['id'])
                    ->update([
                        'status_bbn_proses' => 1,
                        'no_notice_bbn' => $data['no_notice'],
                        'tgl_notice_bbn' => $data['tgl_notice'],
                        'harga_notice_bbn' => $hargaNotice,
                        'harga_jasa' => $hargaJasa,
                        'pph' => $pph,
                        'pnbp' => $pnbp,
                        'subtotal' => $subtotal,
                        'no_pol' => $k['no_pol'],
                        'status_bbn_kelengkapan' => $k['status_bbn_kelengkapan'],
                        'ukuran' => $k['ukuran'],
                        'warna_dasar' => $k['warna_dasar'],
                        'bulan_pajak' => $k['bulan_pajak'],
                        'tahun' => $k['tahun'],
                        'proses' => $k['proses'],
                        'keterangan' => $k['keterangan'],
                        'info_kelengkapan' => $k['info_kelengkapan'],
                    ]);
            }

            $trn = DB::table('po_trns')
                ->where('no_po','=',$noPO)
                ->where('status_bbn_proses','=',0);
            if ($trn->count() == 0) {
                DB::table('po_mst')
                    ->where('no_po','=',$noPO)
                    ->update([
                        'status_notice' => 1,
                        'total' => DB::raw('total+'.$total)
                    ]);
            } else {
                DB::table('po_mst')
                    ->where('no_po','=',$noPO)
                    ->update([
                        'total' => DB::raw('total+'.$total)
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
