<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Mentor;
use App\Models\Division;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use GrahamCampbell\ResultType\Success;

class ParticipantController extends Controller
{

    public function formPengajuan()
    {
        return view('peserta/pengajuan');
    }

    public function dataParticipant()
    {
        $submissions = Participant::NotActive()->get();
        $divisions = Division::all();
        $mentors = Mentor::all();
        $participants = Participant::with('Division','Mentor')->Active()->get();
        return view('hc/datapeserta',compact('submissions','divisions','mentors','participants'));
    }

    public function rejectSubmission()
    {
    }

    public function submission(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'school_name'=>'required',
            'school_type'=>'required',
            'major'=>'required',
            'email'=>'required',
            'file_application_letter'=>'required|max:10240',
            'file_cv'=>'required|max:10240',
            'file_transcript'=>'required|max:10240',
        ]);
        $fileNameApplicationLetter = null;
        $fileNameCV = null;
        $fileNameTranscipt = null;

        if ($request->hasFile('file_application_letter')) {
            $image = $request->file_application_letter;
            $dest = 'file_submission';
            $fileNameApplicationLetter = $request->name . '_File PKL_' . date("YmdHis") . "." . $image->getClientOriginalExtension();
            $image->move($dest, $fileNameApplicationLetter);
        }

        if ($request->hasFile('file_cv')) {
            $image = $request->file_cv;
            $dest = 'file_submission';
            $fileNameCV = $request->name . '_File CV_' . date("YmdHis") . "." . $image->getClientOriginalExtension();
            $image->move($dest, $fileNameCV);
        }

        if ($request->hasFile('file_transcript')) {
            $image = $request->file_transcript;
            $dest = 'file_submission';
            $fileNameTranscipt = $request->name . '_File Transcript_' . date("YmdHis") . "." . $image->getClientOriginalExtension();
            $image->move($dest, $fileNameTranscipt);
        }

        Participant::create([
            'name'=>$request->name,
            'school_type'=>$request->school_type,
            'school_name'=>$request->school_name,
            'major'=>$request->major,
            'email'=>$request->email,
            'file_application_letter'=>$fileNameApplicationLetter,
            'file_cv'=>$fileNameCV,
            'file_transcript'=>$fileNameTranscipt,
        ]);

        toast('Pengajuan berhasil disubmit','success');
        return redirect('/login');
    }

    public function acceptSubmission(Participant $id, Request $request){
        $request->validate([
            'division'=>'required',
            'mentor'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);
        try{
            $password = Str::random(8);
            $user = User::create([
                'email'=>$id->email,
                'password'=>bcrypt($password),
                'role'=>'Participant',
            ]);
    
            $id->update([
                'participant_code'=>$this->generateCode($id->id, $id->school_type),
                'division_id' => $request->division,
                'mentor_id'=>$request->mentor,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'status'=>1,
                'user_id'=>$user->id,
            ]);

     
    
            toast('Peserta Berhasil diterima','success');
            return back();
        }
        catch(Exception $e){
            toast($e->getMessage(),'error');
            return back();
        }
        
    }

    private function generateCode($id, $schoolType){
        $code = "KP00".$id;
        if($schoolType == 'Universitas'){
            $code = "KP00".$id;
        }

        else if($schoolType == 'SMK'){
            $code = "PKL00".$id;
        }

        return $code;
    }
}
