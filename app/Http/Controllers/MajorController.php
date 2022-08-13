<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Major;
use App\Models\Participant;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return view('hc.jurusan.index', [
            'majors' => $majors,
        ]);
    }

    public function store(Request $request)
    {
        $new_major = Major::create([
            'name' => $request->name,
        ]);
        toast("Jurusan " . $new_major->name . " ditambahkan", 'success');
        return redirect()->route('major.index');
    }

    public function update(Request $request, $id)
    {
        $major = Major::where('id', $id)->first();
        $major->update([
            'name' => $request->major_name,
        ]);
        toast("Jurusan diubah", 'success');
        return redirect()->route('major.index');
    }

    public function destroy($id)
    {
        $major = Major::where('id', $id)->first();
        $major_name = $major->name;

        $participant = Participant::where('major_id', $id)->first();
        if ($participant) {
            toast("Jurusan " . $major_name . " tidak dapat dihapus, digunakan oleh peserta " . $participant->name . "!", 'error');
            return redirect()->route('major.index');
        }

        $major->delete();
        toast("Jurusan " . $major_name . " dihapus", 'success');
        return redirect()->route('major.index');
    }
}
