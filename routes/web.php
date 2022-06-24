<?php

use App\Http\Controllers\DataPengajuanController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\UserController;
use App\Models\Participant;
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
    return redirect()->intended('/login');
});
Route::group(['middleware'=>'guest'],function(){
    Route::get('/login',[UserController::class,'loginView']);
    Route::post('/login',[UserController::class,'login']);
    Route::post('/submission',[ParticipantController::class,'submission']);
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard',[UserController::class,'dashboard']);
    Route::get('/logout',[UserController::class,'logout']);
});

Route::group(['middleware'=>'isHC'],function(){
    Route::get('/data-pembimbing', [MentorController::class, 'dataPembimbing']);
    Route::put('/data-peserta/{id}/accept',[ParticipantController::class,'acceptSubmission']);
    Route::get('/data-peserta', [ParticipantController::class, 'dataParticipant']);   
    Route::get('/data-divisi', [DivisionController::class, 'dataDivisi']);    
});

Route::group(['middleware'=>'isMentor'],function(){

});

Route::group(['middleware'=>'isParticipant'],function(){

});

Route::get('/presensi', function () {
    return view('pembimbing/presensi');
});

//Dashboard
Route::get('/dashboard', function () {
    return view('hc/dashboard');
});
Route::get('/dashboardPembimbing', function () {
    return view('pembimbing/dashboardPembimbing');
});
Route::get('/dashboardPeserta', function () {
    return view('peserta/dashboardPeserta');
});
// pengajuan
Route::get('/pengajuan', [ParticipantController::class, 'formPengajuan']);
// Master AKUN
// Route::get('/masterakun', [UserController::class, 'masterAkun']);
Route::get('/master-akun', function () {
    return view('hc/masterAkun');
});
Route::get('/createAccountMentor', function () {
    return view('hc/createAccountMentor');
});
Route::get('/editAccountMentor', function () {
    return view('hc/editAccountMentor');
});
Route::get('/createAccountParticipants', function () {
    return view('hc/createAccountParticipants');
});
Route::get('/editAccountParticipants', function () {
    return view('hc/editAccountParticipants');
});
//Penerimaan
Route::get('/penerimaan', function () {
    return view('hc/penerimaan');
});
//Pembimbing
Route::get('/createMentor', function () {
    return view('hc/createMentor');
});
Route::get('/editMentor', function () {
    return view('hc/edit');
});
//Presensi
Route::get('/presensiPeserta', function () {
    return view('peserta/presensiPeserta');
});
Route::get('/inputPresensi', function () {
    return view('peserta/inputPresensi');
});
//Tugas
Route::get('/tugasPembimbing', function () {
    return view('pembimbing/tugasPembimbing');
});
