<?php

namespace App\Http\Controllers;

use App\msSamsat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_MasterSamsat extends Controller
{
    public function index() {
        return view('dashboard.master.samsat.list');
    }

    public function add() {
        return view('dashboard.master.samsat.baru');
    }

    public function edit($id) {
        $data = DB::table('ms_samsat')->where('id','=',$id)->first();
        return view('dashboard.master.samsat.edit')->with('data',$data);
    }

    public function list() {
        $data['data'] = msSamsat::all();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $nama = $request->nama;
        $provinsi = $request->provinsi;
        $kota = $request->kota;
        $alamat = $request->alamat;

        try {
            DB::beginTransaction();
            if ($type == 'baru') {
                $dealer = new msSamsat();
                $dealer->nama = $nama;
                $dealer->provinsi = $provinsi;
                $dealer->kota = $kota;
                $dealer->alamat = $alamat;
                $dealer->save();
            } elseif ($type == 'edit') {
                DB::table('ms_samsat')
                    ->where('id','=',$request->id)
                    ->update([
                        'nama' => $nama,
                        'provinsi' => $provinsi,
                        'kota' => $kota,
                        'alamat' => $alamat,
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
