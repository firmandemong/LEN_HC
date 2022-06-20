<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{

    public function formPengajuan()
    {
        return view('peserta/pengajuan');
    }

    public function dataPengajuan()
    {
        $submissions = Participant::NotActive()->get();
        return view('hc/datapengaju',compact('submissions'));
    }

    public function dataParticipant()
    {
        return view('hc/datapeserta');
    }

    public function acceptSubmission()
    {
    }

    public function rejectSubmission()
    {
    }

    public function submission(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'univ'=>'required',
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
            'univ'=>$request->univ,
            'major'=>$request->major,
            'email'=>$request->email,
            'file_application_letter'=>$fileNameApplicationLetter,
            'file_cv'=>$fileNameCV,
            'file_transcript'=>$fileNameTranscipt,
        ]);

        toast('Pengajuan berhasil disubmit','success');
        return redirect('/login');
    }
}
