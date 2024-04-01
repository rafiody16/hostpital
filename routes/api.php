<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('user', [UserController::class, 'insert']);
Route::post('user', [UserController::class, 'login']);
// Route::middleware('auth:api')->group(function() {
//     Route::post('login', [UserController::class, 'login'])->name('login');
// });

Route::post('pasien', [PasienController::class, 'insert']);
Route::put('pasien/{id}', [PasienController::class, 'update']);
Route::delete('pasien/{id}', [PasienController::class, 'delete']);
Route::get('pasien', [PasienController::class, 'getAll']);
Route::get('pasien/{id_pasien}', [PasienController::class, 'getById']);

Route::post('dokter', [DokterController::class, 'insert']);
Route::put('dokter/{id}', [DokterController::class, 'update']);
Route::delete('dokter/{id}', [DokterController::class, 'delete']);
Route::get('dokter', [DokterController::class, 'getAll']);
Route::get('dokter/{id_dokter}', [DokterController::class, 'getById']);

