<?php

namespace App\Http\Controllers;

use App\sysProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class c_SystemProfile extends Controller
{
    public function index() {
        return view('dashboard.system_utility.company-info.list');
    }

    public function add() {
        return view('dashboard.system_utility.company-info.baru');
    }

    public function edit($id) {
        $data = DB::table('sys_profile')
            ->where('id','=',$id)
            ->first();
        return view('dashboard.system_utility.company-info.edit')->with('data',$data);
    }

    public function list() {
        $data['data'] = sysProfile::all();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $name = $request->name;
        $value = $request->value;

        try {
            DB::beginTransaction();
            if ($type == 'baru') {
                $profile = new sysProfile();
                $profile->name = $name;
                $profile->value = $value;
                $profile->save();
            } elseif ($type == 'edit') {
                $profile = sysProfile::find($request->id);
                $profile->name = $name;
                $profile->value = $value;
                $profile->save();
            }
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }
}
