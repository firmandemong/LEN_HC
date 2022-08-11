<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index(){
        return view('pembimbing.task.index');
    }
    public function getTaskByMentor(){
        $tasks = Task::with('getParticipant')->where('created_id', $this->getUser()->id)->get();
        return view('pembimbing.task.index',compact('tasks'));
    }

    public function create(){
        $participants = Participant::where('mentor_id',$this->getUser()->id)->get();
        return view('pembimbing.task.create',compact('participants'));
    }

    public function store(Request $request){
        $request->validate([
            'task_name'=>'required',
            'task_description'=>'required',
            'deadline'=>'required',
            'participant'=>'required',
        ]); 
   
        Task::create([
            'name'=>$request->task_name,
            'description'=>$request->task_description,
            'deadline'=>$request->deadline,
            'participant_id'=>$request->participant,
            'created_id'=>$this->getUser()->id,
        ]);

        toast("Tugas berhasil dibuat",'success');
        return redirect('list-tugas');
    }
}
                                    
