<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function getDivision(){
        return view('hc.dataDivisi');
    }
}
