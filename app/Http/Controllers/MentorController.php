<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Mentor;
use App\Models\User;
use App\Models\Division;

use GrahamCampbell\ResultType\Success;

class MentorController extends Controller
{

    public function index()
    {
        $mentors = Mentor::all();
        return view('hc/mentor/index', [
            'mentors' => $mentors,
        ]);
    }

    public function create()
    {
        $divisions = Division::all();
        return view('hc/mentor/create', [
            'divisions' => $divisions,
        ]);
    }
    public function store(Request $request)
    {
        $new_user = User::create([
            'email' => $request->email,
            'password' => bcrypt('password'),
            'role' => 'Mentor',
        ]);

        $new_mentor = Mentor::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'gedung' => $request->gedung,
            'lantai' => $request->lantai,
            'division_id' => $request->divisi,
            'user_id' => $new_user->id,
        ]);
        $password = 'password';

        Mail::to($new_user->email)->send(new \App\Mail\sendAccountMail($new_user->email, $password));
        toast("Pembimbing ". $new_mentor->name ." ditambahkan", 'success');
        return redirect()->route('mentor.index');
    }

    public function edit($id)
    {
        $divisions = Division::all();
        $mentor = Mentor::where('id', $id)->first();
        return view('hc/mentor/edit', [
            'divisions' => $divisions,
            'mentor' => $mentor,
        ]);   
    }

    public function update(Request $request, $id)
    {
        $mentor = Mentor::where('id', $id)->first();
        $mentor->update([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'gedung' => $request->gedung,
            'lantai' => $request->lantai,
            'division_id' => $request->divisi,
        ]);
        toast('Pembimbing diubah', 'success');
        return redirect()->route('mentor.index');
    }

    public function destroy($id)
    {
        $mentor = Mentor::where('id', $id)->first();
        $name = $mentor->name;
        $mentor->delete();
        toast('Pembimbing '. $name.' dihapus', 'success');
        return redirect()->route('mentor.index');
    }
}
