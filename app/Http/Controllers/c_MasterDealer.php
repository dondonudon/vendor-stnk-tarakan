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
        $data = DB::table('ms_dealer')->where('id','=',$id)->first();
        return view('dashboard.master.dealer.edit')->with('data',$data);
    }

    public function list() {
        $data['data'] = msDealer::all();
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
        $hargaJasa = $request->harga_jasa;
        $keterangan = $request->keterangan;

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
                $dealer->keterangan = $keterangan;
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
                        'keterangan' => $keterangan,
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
