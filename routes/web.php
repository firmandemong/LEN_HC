<?php

use App\Http\Controllers\DataPengajuanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/datapengajuan', function () {
    return view('hc/datapengaju');
});
Route::get('/datapembimbing', function () {
    return view('hc/datapembimbing');
});
Route::get('/datapeserta', function () {
    return view('hc/datapeserta');
});
Route::get('/dashboard', function () {
    return view('hc/dashboard');
});
Route::get('/pengajuan', function () {
    return view('peserta/pengajuan');
});
Route::get('/masterakun', function () {
    return view('hc/masterAkun');
});
Route::get('/penerimaan', function () {
    return view('hc/penerimaan');
});
Route::get('/dashboardPembimbing', function () {
    return view('pembimbing/dashboard');
});
