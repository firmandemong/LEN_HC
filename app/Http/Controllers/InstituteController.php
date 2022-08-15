<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Institute;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstituteController extends Controller
{
    public function index()
    {
        $institutes = Institute::all();

        return view('hc.instansi.index', [
            'institutes' => $institutes,
        ]);
    }

    public function history($id)
    {
        $countParticipant = Participant::where('school_id', $id)->where(function ($query) {
            $query->where('status', 2)->orWhere('status', 4);
        })->count();

        $participant = Participant::where('school_id', $id)->where(function ($query) {
            $query->where('status', 2)->orWhere('status', 4);
        })->get();

        $averageParticipantScore = 0;
        if (!empty($participant)) {
            $totalScore = 0;
            $totalParticipant = 0;
            $participantScore = Participant::whereHas('getEvaluation')->where('school_id', $id)->where(function ($query) {
                $query->where('status', 2)->orWhere('status', 4);
            })->get();
            foreach ($participantScore as $score) {
                $totalScore += $score->getEvaluation->average;
                $totalParticipant += 1;
            }
            $averageParticipantScore = round($totalScore / $totalParticipant, 1);
        }

        $mostDivisionCount = '-';
        if ($participant->count() > 0) {
            $getInstance = $participant->toQuery()->select('division_id', DB::raw("count(division_id) as jumlah"))->groupBy('division_id')->get();
            $maxInstance = 0;
            foreach ($getInstance as $participant) {
                if ($participant->jumlah > $maxInstance) {
                    $maxInstance = $participant->jumlah;
                    $participantByInstance = $participant->division_id;
                }
            }
        }
        if (!empty($participantByInstance)) {
            $mostDivisionCount = Division::where('id', $participantByInstance)->first()->name;
        }

        return response()->json(['countParticipant' => $countParticipant, 'mostDivisionCount' => $mostDivisionCount, 'averageParticipantScore' => $averageParticipantScore]);
    }

    public function update(Request $request, $id)
    {
        $institute = Institute::where('id', $id)->first();
        $institute->update([
            'name' => $request->institute_name,
        ]);
        toast("Instansi diubah", 'success');
        return redirect()->route('institute.index');
    }

    public function destroy($id)
    {
        $institute = Institute::where('id', $id)->first();
        $institute_name = $institute->name;

        $institute->delete();
        toast("Instansi " . $institute_name . " dihapus", 'success');
        return redirect()->route('institute.index');
    }
}
