<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $participants = Participant::where('mentor_id', $this->getUser()->id)->where('status', 2)->get();
        return view('mentor.score.index', compact('participants'));
    }

    public function Evaluate()
    {
    }

    public function getEvaluationByParticipant()
    {
        return view('participant.result');
    }
}
