<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParticipantController extends Controller
{

    public function formPengajuan()
    {
    }

    public function dataPengajuan()
    {
        return view('hc/datapengaju');
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

    public function submission()
    {
    }
}
