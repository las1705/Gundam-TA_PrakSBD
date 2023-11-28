<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    public function viewLogin()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($request->role == 'admin'){
            $q = 'SELECT * FROM admin WHERE username = :username;';
            $intend = '/adminHome';
        }
        else{
            $q = 'SELECT * FROM customer WHERE username = :username;';
            $intend = '/customerHome';
        }

        $data = DB::select( $q,
            [

                'username'=>$request->username,
            ]);
        if($data == null){
//            dd('salah user');
            return view('login')->with(['fail'=> 'Username no exist']);
        }
        $data1 = DB::table($request->role)->where('username', $request->username)->first();
        if($data1->password != $request->password){
            dd($request->password);
            return view('login')->with(['fail'=> 'Wrong Password']);
        }

//        dd($intend);
        session(['user' => $data1]);

        return redirect()->intended($intend);
    }



}
