<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function clockIn()
    {
        $check = Attendance::where(['participant_id'=>$this->getUser()->id,'date'=>date('Y-m-d')])->first();
        if(!empty($check)){
            toast('Anda sudah clock in','error');
            return back();
        }
        Attendance::create([
            'participant_id'=>$this->getUser()->id,
            'date'=>date('Y-m-d'),
            'clockIn'=>date('H:i:s')
        ]);
        toast('Clock In berhasil dilakukan','success');
        return back();
    }

    public function clockOut(Request $request)
    {
        $request->validate([
            'activity'=>'required'
        ]);
        $attendance = Attendance::where(['participant_id'=>$this->getUser()->id,'date'=>date('Y-m-d')])->first();
        if(empty($attendance)){
            toast('Anda belum melakukan clock in','error');
            return back();
        }
        $attendance->update([
            'description'=>$request->activity,
            'clockOut'=>date('H:i:s')

        ]);
        toast('Clock Out berhasil dilakukan','success');

        return back();
    }

    public function getAttendanceByMentor(){
        return view('pembimbing.participant-attendance.index');
    }
}
