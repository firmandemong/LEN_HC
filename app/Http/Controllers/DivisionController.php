<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    public function index(){
        $divisions = Division::all();
        return view('hc.division.index',[
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
            'name'=>$request->division_name,
        ]);
        toast("Divisi ". $new_division->name ." ditambahkan", 'success');
        return redirect()->route('division.index');
    }

    public function show($id)
    {
        # code...
    }

    public function edit($id)
    {
        $division = Division::where('id', $id)->first();
        // dd($division);
        return view('hc.division.edit', [
            'division' => $division,
        ]);
    }

    public function update(Request $request, $id)
    {
        # code...
        $division = Division::where('id', $id)->first();
        $division->update([
            'name' => $request->division_name,
        ]);
        toast('Data divisi diubah', 'success');
        return redirect()->route('division.index');
    }

    public function destroy($id)
    {
        # code...
        $division = Division::where('id', $id)->first();
        $name = $division->name;
        $division->delete();
        toast('Divisi '. $name.' dihapus', 'success');
        return redirect()->route('division.index');
    }
}
