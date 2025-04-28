<?php

use App\Http\Controllers\Api\GetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController as ApiLogin;
use App\Http\Controllers\Api\ReportEksekutorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/login',[ApiLogin::class, 'login'])->name('loginApi');
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('v1/user',[ApiLogin::class, 'user'])->name('userApi');
    Route::post('v1/report/get',[ReportEksekutorController::class, 'getReport'])->name('getReport');
    Route::post('v1/tambah/report',[ReportEksekutorController::class, 'buatReport'])->name('buatReport');
    Route::post('v1/tambah/timeoff',[ReportEksekutorController::class, 'buatTimeOff'])->name('buatTimeOff');
});
Route::get('v1/get/lokasi', [GetController::class, 'getLokasi'])->name('getLokasi');
