<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\StatusKehadiranController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\AttendanceController;
use Carbon\Carbon;
//use App\Http\Controllers\GenderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('kehadirans.index');
});

Route::get('/kehadirans', function () {
    return view('kehadirans.index');
})->middleware(['auth', 'verified', 'prevent-back-history'])->name('kehadirans');

Route::get('/X', function () {
    return view('welcome');
})->middleware(['auth', 'verified', 'prevent-back-history'])->name('X');

## middleware digunakan agar tidak bisa akses secara sembarangan
Route::resource('karyawans', KaryawanController::class)->middleware(['auth', 'verified', 'prevent-back-history']);
Route::resource('jabatans', JabatanController::class)->middleware(['auth', 'verified', 'prevent-back-history']);
Route::resource('kehadirans', KehadiranController::class)->middleware(['auth', 'verified', 'prevent-back-history']);
Route::resource('pegawais', PegawaiController::class)->middleware(['auth', 'verified', 'prevent-back-history']);
Route::resource('lemburs', LemburController::class)->middleware(['auth', 'verified', 'prevent-back-history']);
Route::resource('statusKehadirans', StatusKehadiranController::class)->middleware(['auth', 'verified', 'prevent-back-history']);
//Route::get('/attendance-check', [\App\Http\Controllers\AttendanceController::class, 'checkAttendance'])->name('attendance.check');
Route::get('/attendance-check', [\App\Http\Controllers\AttendanceController::class, 'checkAttendance'])->middleware(['auth', 'verified', 'prevent-back-history']);
// Route::get('/attendance-check', [\App\Http\Controllers\AttendanceController::class, 'checkAttendance'], function () {
//     $newAttendances = DB::table('kehadirans')
//         ->whereDate('created_at', Carbon::today())
//         ->middleware(['auth', 'verified'])
//         ->get();

//     return view('attendance-check', ['newAttendances' => $kehadirans]);
// });
//Route::get('/check-attendance', AttendanceController::class)->middleware(['auth', 'verified']);
//Route::get('/karyawans', [KaryawanController::class, 'index'])->middleware(['auth', 'verified'])->name('karyawans');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
