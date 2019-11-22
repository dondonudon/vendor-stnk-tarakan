<?php

namespace App\Http\Controllers;

use App\sysPermission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class c_MasterUserManagement extends Controller
{
    public function index() {
        return view('dashboard.master.user-management.list');
    }

    public function add() {
        return view('dashboard.master.user-management.baru');
    }

    public function edit($username) {
        $data = DB::table('users')->where('username','=',$username)->first();
        $dtCheck = DB::table('sys_permissions')->select('id_menu')->where('username','=',$username)->get();
        $check = [];
        foreach ($dtCheck as $c) {
            $check[] = $c->id_menu;
        }
        return view('dashboard.master.user-management.edit')->with('data',$data)->with('check',$check);
    }

    public function list() {
        $data['data'] = DB::table('users')
            ->whereNotIn('username',['dev'])
            ->get();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $result = '';
        $type = $request->type;
        $username = $request->username;
        $name = $request->name;
        $email = '';
        $permission = $request->permission;

        if ($request->email !== null || $request->email !== '') {
            $email = $request->email;
            $dtUser = DB::table('users')
                ->where('username','=',$username)
                ->orWhere('email','=',$email);
        } else {
            $dtUser = DB::table('users')->where('username','=',$username);
        }

        try {
            DB::beginTransaction();

            if ($type == 'baru') {
                if ($dtUser->doesntExist()) {
                    $user = new User();
                    $user->username = $username;
                    $user->password = Crypt::encryptString($username);
                    $user->name = $name;
                    $user->email = $email;
                    $user->save();

                    foreach ($permission as $p) {
                        $userPermission = new sysPermission();
                        $userPermission->username = $username;
                        $userPermission->id_menu = $p;
                        $userPermission->save();
                    }

                    $result = 'success';
                } else {
                    $result = 'Username atau Email sudah terdaftar';
                }
            } elseif ($type == 'edit') {
                DB::table('users')
                    ->where('username','=',$username)
                    ->update([
                        'name' => $name,
                        'email' => $email,
                    ]);
                DB::table('sys_permissions')->where('username','=',$username)->delete();
                foreach ($permission as $p) {
                    $userPermission = new sysPermission();
                    $userPermission->username = $username;
                    $userPermission->id_menu = $p;
                    $userPermission->save();
                }
                $result = 'success';
            }
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }
}
