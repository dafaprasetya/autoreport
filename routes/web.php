<?php

use App\Http\Controllers\ITController;
use App\Http\Controllers\ServiceController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

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

Route::get('/counter', Counter::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// SERVICE
Route::middleware(['auth', 'bagian:Service,Manager'])->group(function(){
    // STAF
    Route::middleware(['jabatan:Staff,Manager'])->group(function(){
        Route::get('/service/masterga', [ServiceController::class, 'masterGa'])->name('mastergaservice');
        Route::get('/service/report/harian', [ServiceController::class, 'reportHarian'])->name('reportHarianService');
        Route::get('/service/report/harian/{tanggal}', [ServiceController::class, 'reportHarianDetail'])->name('reportHarianServiceDetail');
        Route::get('/service/report/tambah', [ServiceController::class, 'tambahReport'])->name('tambahReportService');
    });
    // EKSEKUTOR
    Route::middleware(['jabatan:Eksekutor,Manager'])->group(function(){

    });
});
Route::middleware(['auth', 'bagian:IT,Manager'])->group(function(){
    // STAFF
    Route::middleware(['jabatan:Staff,Manager'])->group(function(){
        Route::get('/it', [ITController::class, 'index'])->name('itadmin');
    });
    // EKSEKUTOR
    Route::middleware(['jabatan:Eksekutor,Manager'])->group(function(){

    });
});
