<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentsControlller;

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

Route::get('doctor/incoming-patients',[AppointmentsControlller::class,'IncomingPatients'])->name('new.patient.index');

// Route::get('doctor/complete-patients',[AppointmentsControlller::class,'CompletePatients'])->name('new.patient.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
