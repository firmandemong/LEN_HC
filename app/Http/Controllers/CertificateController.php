<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        return view('hc.participant.certificate');
    }

    public function upload()
    {
    }

    public function getCertificate()
    {
    }
}
