<?php

use App\Http\Controllers\Api\LoginController as ApiLogin;
use App\Http\Controllers\ITController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserManagementController;
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
Route::get('/profile', [UserManagementController::class, 'userProfile'])->name('userProfile');
Route::post('/profile/edit/{id}', [UserManagementController::class, 'editUser'])->name('editUser');
Route::post('/profile/edi/password/{id}', [UserManagementController::class, 'editPassword'])->name('editPassword');

// SERVICE
Route::middleware(['auth', 'bagian:Service,Manager'])->group(function(){
    // STAF
    Route::middleware(['jabatan:Staff,Manager'])->group(function(){
        Route::get('/service', [ServiceController::class, 'dashboard'])->name('dashboardService');
        Route::get('/service/masterga', [ServiceController::class, 'masterGa'])->name('mastergaservice');
        Route::get('/service/report/harian', [ServiceController::class, 'reportHarian'])->name('reportHarianService');
        Route::get('/service/report/harian/{tanggal}', [ServiceController::class, 'reportHarianDetail'])->name('reportHarianServiceDetail');
        Route::get('/service/report/tambah', [ServiceController::class, 'tambahReport'])->name('tambahReportService');
        Route::get('/service/report/eksekutor', [ServiceController::class, 'reportEksekutor'])->name('reportEksekutorService');
        Route::get('/service/waitinglist', [ServiceController::class, 'waitingListService'])->name('waitingListService');
    });
    // EKSEKUTOR
    Route::middleware(['jabatan:Eksekutor,Manager'])->group(function(){

    });
});
Route::middleware(['auth', 'bagian:IT,Manager'])->group(function(){
    // STAFF
    Route::middleware(['jabatan:Staff,Manager'])->group(function(){
        Route::get('/it', [ITController::class, 'index'])->name('dashboardIT');
        Route::get('/it/masterga', [ITController::class, 'masterGa'])->name('mastergaIT');
        Route::get('/it/report/harian', [ITController::class, 'reportHarian'])->name('reportHarianIT');
        Route::get('/it/report/harian/new', [ITController::class, 'reportHarianNew'])->name('reportHarianITNew');
        Route::get('/it/report/tambah', [ITController::class, 'tambahReport'])->name('tambahReportIT');
        Route::get('/it/report/tambah/new', [ITController::class, 'tambahReportNew'])->name('tambahReportITNew');
        Route::get('/it/report/eksekutor', [ITController::class, 'reportEksekutor'])->name('reportEksekutorIT');
        Route::get('/it/waitinglist', [ITController::class, 'waitingListIt'])->name('waitingListIt');
        Route::get('/it/user', [ITController::class, 'manageUser'])->name('itUserManage');
    });
    // EKSEKUTOR
    Route::middleware(['jabatan:Eksekutor,Manager'])->group(function(){

    });
});



// API

