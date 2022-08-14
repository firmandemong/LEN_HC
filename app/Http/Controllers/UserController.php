<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DailyTask;
use App\Models\DetailDivisionQuota;
use App\Models\Division;
use App\Models\Institute;
use App\Models\Mentor;
use App\Models\Participant;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        if (Auth::User()->role == 'HC') {
            $submissions = Participant::where('status', 0)->orWhere('status', 1)->count();
            $participants = Participant::where('status', 2)->count();
            $mentors = Mentor::count();
            $divisionCount = Division::count();

            $schools = Institute::with(['Participant'])->get();
            foreach ($schools as $data) {
                $totalPeserta = $data->Participant->count('id');
                $school[] = [
                    'name' => $data->name,
                    'totalPeserta' => $totalPeserta
                ];
            }
            $collectSchool = collect($school);
            $school = $collectSchool->sortByDesc('totalPeserta');

            $divisions = Division::with('getDetailQuota')->get();
            foreach ($divisions as $data) {
                $quota = $data->getDetailQuota->sum('quota');
                $division[] = [
                    'name' => $data->name,
                    'quota' => $quota,
                ];
            }
            $collectDivision = collect($division);
            $division = $collectDivision->sortByDesc('quota');
            return view('hc.dashboard', compact('submissions', 'participants', 'mentors', 'division', 'divisionCount', 'school'));
        } else if (Auth::User()->role == 'Mentor') {
            $data = [];
            $participants = Participant::where('mentor_id', $this->getUser()->id)->where('status', 2)->get();
            $tasks = Task::where('created_id', $this->getUser()->id)->where('status', '!=', 2)->count();
            $kuotas = DetailDivisionQuota::where('division_id', $this->getUser()->division_id)->sum('quota');
            foreach ($participants as $participant) {
                $hour = 0;
                $minute = 0;
                $activities = DailyTask::where('date', date('Y-m-d'))->where('participant_id', $participant->id)->get();
                foreach ($activities as $activity) {
                    $hour += $activity->hour;
                    $minute += $activity->minute;
                }
                $totalTime = DailyTask::countTime($hour, $minute);
                $data[] = [
                    'name' => $participant->name,
                    'time' => $totalTime,
                ];
            }
            return view('mentor.dashboard', compact('participants', 'tasks', 'kuotas', 'data'));
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
