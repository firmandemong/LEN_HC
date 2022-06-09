<?php

use App\Http\Controllers\DataPengajuanController;
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
    return view('login');
});
Route::get('/datapengajuan', [ParticipantController::class, 'dataPengajuan']);
Route::get('/datapembimbing', [MentorController::class, 'dataPembimbing']);
Route::get('/datapeserta', [ParticipantController::class, 'dataParticipant']);
Route::get('/dashboard', function () {
    return view('hc/dashboard');
});
Route::get('/pengajuan', [ParticipantController::class, 'formPengajuan']);
Route::get('/masterakun', [UserController::class, 'masterAkun']);
Route::get('/penerimaan', function () {
    return view('hc/penerimaan');
});
Route::get('/dashboardPembimbing', function () {
    return view('pembimbing/dashboard');
});
