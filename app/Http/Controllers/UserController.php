<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
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
            $presensiToday = Attendance::where(['participant_id'=>$this->getUser()->id,'date'=>date('Y-m-d')])->first();
            $listPresensi = Attendance::where('participant_id',$this->getUser()->id)->get();
            return view('peserta.dashboard',compact('presensiToday','listPresensi'));
            
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
            return back()->withInput()->with('error', 'Username atau Password Salah!');
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
