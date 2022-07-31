<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Mentor;
use App\Models\Division;
use App\Models\Institute;
use App\Models\Major;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use GrahamCampbell\ResultType\Success;

class ParticipantController extends Controller
{

    public function index(){
        $submissions = Participant::query()->NotActive()->orderBy('created_at')->get();
        $acceptedSubmission = Participant::where('status',1)->orderBy('updated_at')->get();
        $rejectedSubmission = Participant::where('status',2)->orderBy('updated_at')->get();
        return view('hc.participant.submission-data',compact('submissions','acceptedSubmission','rejectedSubmission'));
    }

    public function formPengajuan()
    {
        $majors = Major::all();

        $schools = [];
        $allSchool = Institute::select('name')->get();
        foreach($allSchool as $school){
            $schools[] = $school->name;
        }
        
        return view('peserta/pengajuan',compact('majors'))->with(['schools'=>json_encode($schools)]);
    }

    public function getParticipant()
    {
        $submissions = Participant::NotActive()->get();
        $divisions = Division::all();
        $mentors = Mentor::all();
        $participants = Participant::with('Division','Mentor')->Active()->get();
        return view('hc/participant/index',compact('submissions','divisions','mentors','participants'));
    }

    public function edit(Request $request, $id)
    {
        $participant = Participant::where('id', $id)->first();
        $divisions = Division::all();
        $mentors = Mentor::all();
        return view('hc.participant.edit', compact(
            'divisions',
            'mentors',
            'participant',
        ));
    }

    public function update(Request $request, $id)
    {
        $participant = Participant::where('id', $id)->first();
        $participant->update([
            "participant_code" => $request->participant_code,
            "name" => $request->name,
            "school_type" => $request->school_type,
            "school_name" => $request->school_name,
            "major" => $request->major,
            "email" => $request->email,
            "division_id" => $request->division,
            "mentor_id" => $request->mentor,
            "status" => $request->status,
        ]);
        toast('Data calon peserta berhasil diubah','success');
        return redirect('/data-peserta');
    }

    public function rejectSubmission(Participant $id)
    {
        $id->delete();
        toast('Calon Peserta berhasil ditolak','success');
        return back();
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
            'captcha' => 'required|captcha',
        ]);
        $fileNameApplicationLetter = null;
        $fileNameCV = null;
        $fileNameTranscipt = null;

        $checkSchool = Institute::where('name',$request->school_name)->first();
        if(!empty($checkSchool)){
            $school = $checkSchool->id;
        }else{
            $school = Institute::create([
                'name'=>$request->school_name,
            ]);
        }


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
            'school_id'=>$school->id,
            'major_id'=>$request->major,
            'email'=>$request->email,
            'file_application_letter'=>$fileNameApplicationLetter,
            'file_cv'=>$fileNameCV,
            'file_transcript'=>$fileNameTranscipt,
        ]);

        alert()->success('SuccessAlert','Pengajuan berhasil dikirim, Informasi Berikutnya akan dikirim melalui Email');
        return back();
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

            Mail::to($id->email)->send(new \App\Mail\sendAccountMail($id->email, $password));
    
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

    public function getParticipantByMentor(){
        return view('pembimbing.participant-attendance.index');
    }
}

