<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){
        if(Auth::User()->role == 'HC'){
            return view('hc.dashboard');
        }

        else if (Auth::User()->role == 'Mentor'){
            return view('pembimbing.dashboard');
        }

        else if(Auth::User()->role == 'Participant'){
            return view('peserta.dashboard');
            
        }
    }

    public function loginView(){
        return view('login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            toast('Email atau Password Salah', 'error');
            return back()->withInput();
        }
    }

   public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function getProfile()
    {

    }

    public function masterAkun(){
        return view('hc/masterAkun');
    }
}
