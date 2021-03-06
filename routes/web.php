<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DataPengajuanController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Attendance;
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

Route::get('/templates',function(){
    return view('template');
});
Route::group(['middleware'=>'guest'],function(){
    Route::get('/login',[UserController::class,'loginView'])->name('login');
    Route::post('/login',[UserController::class,'login']);
    Route::post('/submission',[ParticipantController::class,'submission']);
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard',[UserController::class,'dashboard']);
    Route::get('/logout',[UserController::class,'logout']);
});

Route::group(['middleware'=>'isHC'],function(){
    Route::get('/data-peserta', [ParticipantController::class, 'getParticipant']); 
    Route::get('/data-peserta/{id}',[ParticipantController::class,'edit'])->name('participant.edit');
    Route::put('/data-peserta/{id}',[ParticipantController::class,'update'])->name('participant.update');
    Route::put('/data-peserta/{id}/accept',[ParticipantController::class,'acceptSubmission']);
    Route::delete('/data-peserta/{id}/reject',[ParticipantController::class,'rejectSubmission']);
    
    Route::resource('/data-pembimbing', MentorController::class, [
        'names' => [
            'index' => 'mentor.index',
            'create' => 'mentor.create',
            'store' => 'mentor.store',
            'edit' => 'mentor.edit',
            'update' => 'mentor.update',
            'destroy' => 'mentor.destroy'
        ]
    ]);    

    Route::resource('/data-divisi', DivisionController::class, [
        'names' => [
            'index' => 'division.index',
            'create' => 'division.create',
            'store' => 'division.store',
            'edit' => 'division.edit',
            'update' => 'division.update',
            'destroy' => 'division.destroy'
        ]
    ]);    
});

Route::group(['middleware'=>'isMentor'],function(){
    Route::get('/list-peserta', [ParticipantController::class, 'getParticipantByMentor']);   
    Route::get('/list-tugas/create', [TaskController::class, 'create']);   
    Route::post('/list-tugas/store', [TaskController::class, 'store']);   
    Route::get('/list-tugas', [TaskController::class, 'getTaskByMentor']);   
    Route::get('/list-presensi', [AttendanceController::class, 'getAttendanceByMentor']);   
});

Route::group(['middleware'=>'isParticipant'],function(){
    Route::post('/clock-in',[AttendanceController::class,'clockIn']);
    Route::put('/clock-out',[AttendanceController::class,'clockOut']);
});

Route::get('/presensi', function () {
    return view('pembimbing/presensi');
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
    return view('hc/editMentor');
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
