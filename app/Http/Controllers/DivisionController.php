<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Mentor;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Models\DetailDivisionQuota;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        return view('hc.division.index', [
            'divisions' => $divisions,
        ]);
    }

    public function create()
    {
        return view('hc.division.create');
    }

    public function store(Request $request)
    {
        $new_division = Division::create([
            'name' => $request->division_name,
            'quota' => $request->quota,
        ]);
        toast("Divisi " . $new_division->name . " ditambahkan", 'success');
        return redirect()->route('division.index');
    }

    public function show($id)
    {
        # code...
    }

    public function edit($id)
    {
        # code...
    }

    public function update(Request $request, $id)
    {
        # code...
        $division = Division::where('id', $id)->first();
        $division->update([
            'name' => $request->division_name,
            'quota' => $request->quota,
        ]);
        toast('Divisi diubah', 'success');
        return redirect()->route('division.index');
    }

    public function destroy($id)
    {
        # code...
        $division = Division::where('id', $id)->first();
        $name = $division->name;
        $mentor = Mentor::where('division_id', $id)->first();
        if ($mentor) {
            toast('Divisi ' . $name . ' tidak dapat dihapus, digunakan oleh pembimbing "' . $mentor->name . '" !', 'error');
            return redirect()->route('division.index');
        }

        $division->delete();
        toast('Divisi ' . $name . ' dihapus', 'success');
        return redirect()->route('division.index');
    }

    public function showQuota()
    {
        $majors = Major::orderBy('name')->get();
        $mentor = Mentor::where('user_id', Auth::id())->first();
        $division = $mentor->getDivision->id;
        $quotas = DetailDivisionQuota::where('division_id');
        return view('mentor.division.kuota', compact('majors', 'division'));
    }

    public function updateQuota(Request $request, Division $id)
    {
        $request->validate([
            'major_id' => 'required',
            'quota' => 'required'
        ]);
        $id->load('getDetailQuota');
        $checkDivisi = $id->getDetailQuota->where('major_id', $request->major_id)->first();
        if (empty($checkDivisi)) {
            $id->getDetailQuota()->create([
                'major_id' => $request->major_id,
                'quota' => $request->quota
            ]);
        } else {
            $checkDivisi->update([
                'quota' => $request->quota
            ]);
        }

        toast('Kuota Berhasil di update', 'success');
        return back();
    }

    public function getMentor($id)
    {
        $mentors = Mentor::where('division_id', $id)->get();
        return response()->json(['mentors' => $mentors]);
    }

    public function getQuota($id)
    {
        $quotas = DetailDivisionQuota::where('division_id', $id)->join('majors', 'detail_division_quotas.major_id', '=', 'majors.id')->get();
        return response()->json(['quotas' => $quotas]);
    }
}
