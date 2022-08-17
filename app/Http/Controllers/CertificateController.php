<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function index()
    {
        $participants = Participant::with('Division', 'Mentor')->Finished()->get();
        return view('hc.participant.certificate', compact('participants'));
    }

    public function upload(Request $request, Participant $id)
    {
        // dd($request->file_cert);
        if (!$request->hasFile('file_cert')) {
            toast('Tolong pilih file untuk di upload', 'error');
            return back();
        }
        
        $file = $request->file_cert;
        $dest = 'certificate';
        $fileNameCertificate = 'certificate_' . $id->participant_code . '_' . $id->name . "." . $file->getClientOriginalExtension();
        $file->move($dest, $fileNameCertificate);

        Certificate::create([
            'participant_id' => $id->id,
            'file' => $fileNameCertificate,
            'uploaded_at' => date('Y-m-d'),
        ]);
        toast('Certificate berhasil diupload', 'success');
        return back();
    }

    public function getCertificate()
    {
    }
}
