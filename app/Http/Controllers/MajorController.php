<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index(){
        return view('hc.jurusan.index');
    }
}
