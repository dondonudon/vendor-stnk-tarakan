<?php

namespace App\Http\Controllers;

use App\msDealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_MasterDealer extends Controller
{
    public function index() {
        return view('dashboard.master.dealer.list');
    }

    public function add() {
        return view('dashboard.master.dealer.baru');
    }

    public function edit($id) {
        $data = DB::table('ms_dealer')
            ->select('ms_dealer.id','ms_dealer.nama','ms_dealer.provinsi as id_provinsi','wilayah_provinsi.name as provinsi','ms_dealer.kota as id_kota','wilayah_kota.name as kota','ms_dealer.alamat','ms_dealer.telp','ms_dealer.pic','ms_dealer.jatuh_tempo','ms_dealer.harga_jasa','ms_dealer.keterangan','ms_dealer.created_at')
            ->where('ms_dealer.id','=',$id)
            ->join('wilayah_kota','ms_dealer.kota','=','wilayah_kota.id')
            ->join('wilayah_provinsi','ms_dealer.provinsi','=','wilayah_provinsi.id')
            ->first();
        return view('dashboard.master.dealer.edit')->with('data',$data);
    }

    public function list() {
        $data['data'] = DB::table('ms_dealer')
            ->select('ms_dealer.id','ms_dealer.nama','ms_dealer.provinsi as id_provinsi','wilayah_provinsi.name as provinsi','ms_dealer.kota as id_kota','wilayah_kota.name as kota','ms_dealer.alamat','ms_dealer.telp','ms_dealer.pic','ms_dealer.jatuh_tempo','ms_dealer.harga_jasa','ms_dealer.keterangan','ms_dealer.created_at')
            ->join('wilayah_kota','ms_dealer.kota','=','wilayah_kota.id')
            ->join('wilayah_provinsi','ms_dealer.provinsi','=','wilayah_provinsi.id')
            ->get();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $nama = $request->nama;
        $provinsi = $request->provinsi;
        $kota = $request->kota;
        $alamat = $request->alamat;
        $telp = $request->telp;
        $pic = $request->pic;
        $jatuhTempo = $request->jatuh_tempo;
        $hargaJasa = str_replace(',','',$request->harga_jasa);

        try {
            DB::beginTransaction();
            if ($type == 'baru') {
                $dealer = new msDealer();
                $dealer->nama = $nama;
                $dealer->provinsi = $provinsi;
                $dealer->kota = $kota;
                $dealer->alamat = $alamat;
                $dealer->telp = $telp;
                $dealer->pic = $pic;
                $dealer->jatuh_tempo = $jatuhTempo;
                $dealer->harga_jasa = $hargaJasa;
                $dealer->keterangan = ($request->keterangan == null) ? '' : $request->keterangan;
                $dealer->save();
            } elseif ($type == 'edit') {
                DB::table('ms_dealer')
                    ->where('id','=',$request->id)
                    ->update([
                        'nama' => $nama,
                        'provinsi' => $provinsi,
                        'kota' => $kota,
                        'alamat' => $alamat,
                        'telp' => $telp,
                        'pic' => $pic,
                        'jatuh_tempo' => $jatuhTempo,
                        'harga_jasa' => $hargaJasa,
                        'keterangan' => ($request->keterangan == null) ? '' : $request->keterangan,
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
