<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function storeLogin()
    {
        $validator = Validator::make(request()->all(),[
            'username' => 'required|string',
            'password' => 'required',
        ]);
        if($validator->fails())
        {
            return redirect('login')->withInput()->withErrors($validator);
        }
        $user = User::where('username',request('username'))->first();
        if($user)
        {
            if($user->password == request('password'))
            {
                if($user->hasRole('admin'))
                {
                    Auth::login($user);
                    return redirect('admin');
                }
                if($user->hasRole('pemilih'))
                {
                    Auth::login($user);
                    return redirect('/');
                }
            }
            return redirect('login')->with('status','Password anda salah');
        }
        return redirect('login')->with('status','User tidak ditemukan');
    }

    public function logout()
    {
        if(Auth::check())
        {
            $user = request()->user();
            Auth::logout($user);
            return redirect('login');
        }
        return redirect('login')->with('status','Anda belum login');
    }
}
