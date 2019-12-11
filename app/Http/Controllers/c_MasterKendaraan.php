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

    public function edit($tipe) {
        $data = DB::table('ms_kendaraan')->where('tipe','=',$tipe)->first();
        return view('dashboard.master.kendaraan.edit')->with('data',$data);
    }

    public function list() {
        $data['data'] = msKendaraan::all();
        return json_encode($data);
    }

    public function updateStatus(Request $request) {
        $tipe = $request->tipe;
        $status = $request->status;
        try {
            DB::beginTransaction();
            DB::table('ms_kendaraan')
                ->where('tipe','=',$tipe)
                ->update([
                    'status' => $status
                ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function submit(Request $request) {
        $type = $request->type;
        $tipeKendaraan = $request->tipe_kendaraan;
        $kode = $request->kode;
        $nama = $request->nama;
        $keterangan = $request->keterangan;

        try {
            DB::beginTransaction();
            if ($type == 'baru') {
                $kendaraan = new msKendaraan();
                $kendaraan->tipe = $tipeKendaraan;
                $kendaraan->kode = $kode;
                $kendaraan->nama = $nama;
                $kendaraan->keterangan = $keterangan;
                $kendaraan->save();
            } elseif ($type == 'edit') {
                DB::table('ms_kendaraan')
                    ->where('tipe','=',$tipeKendaraan)
                    ->update([
                        'kode' => $kode,
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
