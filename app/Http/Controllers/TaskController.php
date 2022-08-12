<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index(){
        $tasks = Task::with('getParticipant')->where('created_id', $this->getUser()->id)->get();
        $participants = Participant::where('mentor_id',$this->getUser()->id)->where('status',2)->get();
        return view('mentor.task.index',compact('participants','tasks'));
    }

    public function getListTaskByParticipant(){
        $tasks = Task::where('participant_id', $this->getUser()->id)->get();
        return view('participant.list-task',compact('tasks'));
    }

    public function store(Request $request){
        $request->validate([
            'task_title'=>'required',
            'task_description'=>'required',
            'participant'=>'required',
        ]); 
        Task::create([
            'title'=>$request->task_title,
            'description'=>$request->task_description,
            'participant_id'=>$request->participant,
            'created_id'=>$this->getUser()->id,
        ]);

        toast("Tugas berhasil dibuat",'success');
        return back();
    }

    public function dailyReport(){
        return view('participant.daily-report');
    }

    public function show($id){
        if(Auth::User()->role == 'Mentor'){
            return view('hc.dashboard');
        }

        else if(Auth::User()->role == 'Participant'){
            return view('participant.detail-task');
        }
    }
}
                                    
