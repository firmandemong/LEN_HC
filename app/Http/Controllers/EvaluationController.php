<?php

namespace App\Http\Controllers;

use App\Models\EvaluationForm;
use App\Models\EvaluationFormDetail;
use App\Models\EvaluationSubject;
use App\Models\Participant;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $participants = Participant::where('mentor_id', $this->getUser()->id)->where('status', 2)->get();
        return view('mentor.score.index', compact('participants'));
    }

    public function evaluationForm($id)
    {
        $subjectSikap = EvaluationSubject::where('category', 'Sikap')->get();
        $subjectKeterampilan = EvaluationSubject::where('category', 'Keterampilan')->get();
        $subjectPengetahuan = EvaluationSubject::where('category', 'Pengetahuan')->get();
        $participant = Participant::where('id', $id)->first();
        return view('mentor.score.evaluation', compact('participant', 'subjectPengetahuan', 'subjectKeterampilan', 'subjectSikap'));
    }

    public function evaluate(Request $request, $id)
    {
        $participant = Participant::where('id', $id)->first();

        $request->validate([
            'score' => 'required'
        ]);

        $formEvaluasi = EvaluationForm::create([
            'participant_id' => $id,
            'evaluator_id' => $this->getUser()->id,
            'evaluate_date' => now(),
        ]);

        $evaluationSubject = EvaluationSubject::all();
        $total = 0;
        $average = 0;
        $predicate = null;
        foreach ($evaluationSubject as $subject) {
            EvaluationFormDetail::create([
                'form_id' => $formEvaluasi->id,
                'subject_id' => $subject->id,
                'point' => $request->score[$subject->id]
            ]);
            $total += $request->score[$subject->id];
        }

        $average = round($total / $evaluationSubject->count(), 1);

        if ($average > 90) {
            $predicate = 'A';
        } else if ($average > 80) {
            $predicate = 'B';
        } else if ($average > 70) {
            $predicate = 'C';
        } else if ($average > 60) {
            $predicate = 'D';
        } else {
            $predicate = 'E';
        }

        $formEvaluasi->update([
            'average' => $average,
            'predicate' => $predicate
        ]);

        $participant->update(['status' => 4]);

        toast('Evaluasi berhasil dilakukan', 'success');
        return redirect('/nilai-peserta');
    }

    public function getEvaluationByParticipant()
    {
        return view('participant.result');
    }
}
