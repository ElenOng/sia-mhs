<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $username = 'username';

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->roles_id == 1){
                // dd($user);
                return redirect()->route('home-student',['auth'=>$user]);
            }else{
                return redirect()->route('beranda',['auth'=>$user]);
            }
        }
        return redirect('/')->with('errors','NIK/NIS atau Kata Sandi anda Salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
