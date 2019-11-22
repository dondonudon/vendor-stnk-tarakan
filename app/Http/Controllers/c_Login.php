<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class c_Login extends Controller
{
    public function index() {
        if (session()->has('status')) {
            if (session()->get('status') == 'logged in') {
                return redirect('/');
            } else {
                return view('login');
            }
        } else {
            return view('login');
        }
    }

    public function submit(Request $request) {
        $username = $request->username;
        $password = $request->password;

        try {
            $dtUser = DB::table('users')
                ->where('username','=',$username);
            if ($dtUser->exists()) {
                $user = $dtUser->first();
                if (Crypt::decryptString($user->password) == $password) {
                    $request->session()->put('status','logged in');
                    $request->session()->put('username',$username);
                    $request->session()->put('name',$user->name);
                    $request->session()->put('userid',$user->id);
                    $request->session()->put('created_at',$user->created_at);
                    $result = 'success';
                } else {
                    $result = 'Password salah.';
                }
            } else {
                $result = 'Username tidak terdaftar.';
            }
            return $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function logout(Request $request) {
        try {
            $request->session()->flush();
            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
