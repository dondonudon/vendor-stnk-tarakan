<?php

namespace App\Http\Controllers;

use App\msHarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_MasterHarga extends Controller
{
    public function index() {
        return view('dashboard.master.harga.list');
    }

    public function add() {
        $kendaraan = DB::table('ms_kendaraan')->select('kode','nama')->get();
        return view('dashboard.master.harga.baru')->with('data',$kendaraan);
    }

    public function edit($id) {
        $kendaraan = DB::table('ms_kendaraan')->select('kode','nama')->get();
        $data = DB::table('ms_harga')->where('id','=',$id)->first();
        return view('dashboard.master.harga.edit')->with('data',$data)->with('kendaraan',$kendaraan);
    }

    public function list() {
        $data['data'] = msHarga::all();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $kodeKendaraan = $request->kode_kendaraan;
        $harga = str_replace(',','',$request->harga);
        $pnbp = str_replace(',','',$request->pnbp);
        $pph = str_replace(',','',$request->pph);

        try {
            DB::beginTransaction();
            if ($type == 'baru') {
                $msHarga = new msHarga();
                $msHarga->kode_kendaraan = $kodeKendaraan;
                $msHarga->harga = $harga;
                $msHarga->pnbp = $pnbp;
                $msHarga->pph = $pph;
                $msHarga->save();
            } elseif ($type == 'edit') {
                DB::table('ms_harga')
                    ->where('id','=',$request->id)
                    ->update([
                        'kode_kendaraan' => $kodeKendaraan,
                        'harga' => $harga,
                        'pnbp' => $pnbp,
                        'pph' => $pph,
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
