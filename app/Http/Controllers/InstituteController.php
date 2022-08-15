<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstituteController extends Controller
{
    public function index()
    {
        return view('hc.instansi.index');
    }

    public function history($id)
    {
        $countParticipant = Participant::where('school_id', $id)->where(function ($query) {
            $query->where('status', 2)->orWhere('status', 4);
        })->count();

        $participant = Participant::where('school_id', $id)->where(function ($query) {
            $query->where('status', 2)->orWhere('status', 4);
        })->get();
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

        return response()->json(['countParticipant' => $countParticipant, 'mostDivisionCount' => $mostDivisionCount]);
    }
}
