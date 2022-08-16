<?php

namespace App\Http\Controllers;

use App\Models\DailyTask;
use App\Models\Participant;
use App\Models\Task;
use App\Models\TaskFileSubmission;
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

    public function updateDailyTask(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        DailyTask::where('id', $id)->update([
            'description' => $request->description,
            'hour' => $request->hour,
            'minute' => $request->minute,
            'task_id' => $request->task,
            'date' => date('Y-m-d')
        ]);

        toast('Kegiatan berhasil diubah', 'success');
        return back();
    }

    public function destroyDailyTask(DailyTask $id)
    {

        $id->delete();

        toast('Kegiatan berhasil dihapus', 'success');
        return back();
    }

    public function getActivityByDate($id, $date)
    {
        $data = null;
        $activities = DailyTask::where('date', $date)->where('participant_id', $id)->get();
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

    public function getParticipantActivity($id)
    {
        $participant = Participant::where('id', $id)->first();
        $data = [];
        $dates = DailyTask::select('date')->where('participant_id', $id)->groupBy('date')->get();
        foreach ($dates as $date) {
            $hour = 0;
            $minute = 0;
            $activities = DailyTask::where('date', $date->date)->where('participant_id', $id)->get();
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
        return view('mentor.list-participant.activity', ['activities' => $data, 'participant' => $participant]);
    }

    public function uploadFile(Request $request, Task $id)
    {
        $request->validate([
            'file' => 'required'
        ]);
        $fileName = '';
        if ($request->hasFile('file')) {
            $file = $request->file;
            $dest = 'file_submission';
            $fileName = $id->id . '_' . $id->title . '_' . date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($dest, $fileName);
        }
        TaskFileSubmission::create([
            'file' => $fileName,
            'task_id' => $id->id
        ]);

        $id->update([
            'status' => 1
        ]);

        toast('File berhasil diupload', 'success');
        return back();
    }

    public function cancelUpload(Request $request, Task $id)
    {
        $id->getFileSubmission()->delete();
        $id->update([
            'status' => 0
        ]);
        toast('Submission berhasil dibatalkan', 'success');
        return back();
    }

    public function approveTask(Task $id)
    {
        $id->update(['status' => 2]);
        toast('Submission berhasil diapprove', 'success');
        return back();
    }
}
