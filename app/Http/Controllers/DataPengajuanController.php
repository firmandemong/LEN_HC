<?php

namespace App\Http\Controllers;

use App\Models\DataPengajuan;
use Illuminate\Http\Request;

class DataPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPengajuans = DataPengajuan::all();
        return view('hc.index', ['dataPengajuans' => $dataPengajuans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoredataPengajuanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DataPengajuan::create($request->all());
        return redirect('/dataPengajuan')->with('success', 'dataPengajuan Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dataPengajuan  $dataPengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(DataPengajuan $dataPengajuan)
    {
        return view('hc.show', compact('dataPengajuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dataPengajuan  $dataPengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPengajuan $dataPengajuan)
    {
        return view('hc.edit', ['dataPengajuan' => $dataPengajuan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedataPengajuanRequest  $request
     * @param  \App\Models\DataPengajuan  $dataPengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPengajuan $dataPengajuan)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $dataPengajuan->update($request->all());
        return redirect('/datapengajuan')->with('success', 'dataPengajuan Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dataPengajuan  $dataPengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPengajuan $dataPengajuan)
    {
        $dataPengajuan->delete();
        return redirect('/datapengajuan')->with('success', 'dataPengajuan deleted');
    }
}
