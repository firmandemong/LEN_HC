<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DailyTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        if (Auth::User()->role == 'HC') {
            return view('hc.dashboard');
        } else if (Auth::User()->role == 'Mentor') {
            return view('mentor.dashboard');
        } else if (Auth::User()->role == 'Participant') {
            $hourToday = 0;
            $minuteToday = 0;
            $hourAll = 0;
            $minuteAll = 0;
            $tasks = Task::where('status', 0)->where('participant_id', $this->getUser()->id)->get();
            $todayActivities = DailyTask::where('participant_id', $this->getUser()->id)->where('date', date('Y-m-d'))->get();
            $allActivities = DailyTask::where('participant_id', $this->getUser()->id)->get();
            $notSubmittedTasks = Task::where('participant_id', $this->getUser()->id)->NotSubmitted()->get();
            foreach ($todayActivities as $activity) {
                $hourToday += $activity->hour;
                $minuteToday += $activity->minute;
            }
            foreach ($allActivities as $activity) {
                $hourAll += $activity->hour;
                $minuteAll += $activity->minute;
            }
            $totalTimeAll = DailyTask::countTime($hourAll, $minuteAll);
            $totalTimeToday = DailyTask::countTime($hourToday, $minuteToday);
            return view('participant.dashboard', compact('tasks', 'todayActivities', 'notSubmittedTasks', 'totalTimeToday', 'totalTimeAll'));
        }
    }

    public function loginView()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            return back()->withInput()->with('error', 'Username atau Password Salah!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function getProfile()
    {
    }

    public function masterAkun()
    {
        return view('hc/masterAkun');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
