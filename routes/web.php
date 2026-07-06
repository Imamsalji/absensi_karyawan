<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('attendance.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::get('/attendance/report', [AttendanceController::class, 'report'])->name('attendance.report');
        Route::resource('users', UserController::class);
    });
    Route::middleware(['auth:sanctum', 'role:karyawan,admin'])->group(function () {
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])
            ->middleware('office.ip')
            ->name('attendance.clockin');

        Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])
            ->middleware('office.ip')
            ->name('attendance.clockout');

        Route::get('/attendance/history', [AttendanceController::class, 'history'])->name('attendance.history');
    });
});

require __DIR__ . '/auth.php';
