<?php

namespace App\Http\Controllers;

use App\Models\DailyTask;
use App\Models\Participant;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('getParticipant')->where('created_id', $this->getUser()->id)->get();
        $participants = Participant::where('mentor_id', $this->getUser()->id)->where('status', 2)->get();
        return view('mentor.task.index', compact('participants', 'tasks'));
    }

    public function getListTaskByParticipant()
    {
        $tasks = Task::where('participant_id', $this->getUser()->id)->get();
        return view('participant.list-task', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_title' => 'required',
            'task_description' => 'required',
            'participant' => 'required',
        ]);
        Task::create([
            'title' => $request->task_title,
            'description' => $request->task_description,
            'participant_id' => $request->participant,
            'created_id' => $this->getUser()->id,
        ]);

        toast("Tugas berhasil dibuat", 'success');
        return back();
    }

    public function dailyReport()
    {
        $data = [];
        $dates = DailyTask::select('date')->where('participant_id', $this->getUser()->id)->groupBy('date')->get();
        foreach ($dates as $date) {
            $hour = 0;
            $minute = 0;
            $activities = DailyTask::where('date', $date->date)->where('participant_id', $this->getUser()->id)->get();
            foreach ($activities as $activity) {
                $hour += $activity->hour;
                $minute += $activity->minute;
            }
            $totalTime = DailyTask::countTime($hour, $minute);
            $data[] = [
                'date' => $date->date,
                'workTime' => $totalTime,
            ];
        }
        return view('participant.daily-report', ['activities' => $data]);
    }

    public function show($id)
    {
        $histories = DailyTask::where('task_id', $id)->orderBy('date')->get();
        $task = Task::find($id);
        if (Auth::User()->role == 'Mentor') {
            return view('mentor.task.detail-task', compact('histories', 'task'));
        } else if (Auth::User()->role == 'Participant') {
            return view('participant.detail-task', compact('histories', 'task'));
        }
    }

    public function storeDailyTask(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        DailyTask::create([
            'description' => $request->description,
            'hour' => $request->hour,
            'minute' => $request->minute,
            'task_id' => $request->task,
            'participant_id' => $this->getUser()->id,
            'date' => date('Y-m-d')
        ]);

        toast('Kegiatan berhasil disubmit', 'success');
        return back();
    }

    public function getActivityByDate($date)
    {
        $data = null;
        $activities = DailyTask::where('date', $date)->where('participant_id', $this->getUser()->id)->get();
        foreach ($activities as $activity) {
            $totalTime = '0 Jam 0 Menit';
            $description = empty($activity->task_id) ? $activity->description : $activity->description . " <b>(" . $activity->Task->title . ")</b>";
            $totalTime = DailyTask::countTime($activity->hour, $activity->minute);
            $data[] = [
                'description' => $description,
                'totalTime' => $totalTime
            ];
        }
        return response()->json(['activities' => $data]);
    }
}
