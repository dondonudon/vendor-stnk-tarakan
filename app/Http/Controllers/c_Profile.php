<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class c_Profile extends Controller
{
    public function edit() {
        $username = \request()->session()->get('username');

        $data = DB::table('users')->where('username','=',$username)->first();
        return view('dashboard.profile.edit')->with('data',$data);
    }

    public function submit(Request $request) {
        $username = $request->username;
        $name = $request->name;
        $email = $request->email;

        try {
            DB::beginTransaction();

            DB::table('users')
                ->where('username','=',$username)
                ->update([
                    'name' => $name,
                    'email' => $email
                ]);

            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function resetPassword() {
        $username = \request()->session()->get('username');
        $data = DB::table('users')
            ->where('username','=',$username)
            ->first();
        return view('reset-password')->with('data',$data);
    }

    public function resetPasswordSubmit(Request $request) {
        $username = $request->session()->get('username');
        $oldPass = $request->password_lama;
        $newPass = $request->password_baru;

        try {
            DB::beginTransaction();

            $dbUser = DB::table('users')
                ->where('username','=',$username)
                ->first();
            if (Crypt::decryptString($dbUser->password) == $oldPass) {
                DB::table('users')
                    ->where('username','=',$username)
                    ->update([
                        'password' => Crypt::encryptString($newPass)
                    ]);
                $result = 'success';
                $request->session()->flush();
            } else {
                $result = 'password salah';
            }

            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
