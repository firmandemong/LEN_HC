<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function getSchedule($id)
    {
        $schedule = Schedule::where('participant_id', $id)->first();
        return response()->json(['schedule' => $schedule]);
    }
}
