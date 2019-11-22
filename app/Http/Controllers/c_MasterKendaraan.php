<?php

namespace App\Http\Controllers;

use App\msKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_MasterKendaraan extends Controller
{
    public function index() {
        return view('dashboard.master.kendaraan.list');
    }

    public function add() {
        return view('dashboard.master.kendaraan.baru');
    }

    public function edit($kode) {
        $data = DB::table('ms_kendaraan')->where('kode','=',$kode)->first();
        return view('dashboard.master.kendaraan.edit')->with('data',$data);
    }

    public function list() {
        $data['data'] = msKendaraan::all();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $kode = $request->kode;
        $nama = $request->nama;
        $keterangan = $request->keterangan;

        try {
            DB::beginTransaction();
            if ($type == 'baru') {
                $kendaraan = new msKendaraan();
                $kendaraan->kode = $kode;
                $kendaraan->nama = $nama;
                $kendaraan->keterangan = $keterangan;
                $kendaraan->save();
            } elseif ($type == 'edit') {
                DB::table('ms_kendaraan')
                    ->where('kode','=',$request->kode)
                    ->update([
                        'nama' => $nama,
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
