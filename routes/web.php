<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);
Route::get('/pesan/{id}', [PesanController::class, 'index'])->name('pesan');
Route::post('/pesan/{id}', [PesanController::class, 'pesan']);
Route::get('/check_out',[PesanController::class,'check_out']);
Route::post('/check_out',[PesanController::class,'check_out']);
Route::get('/check_out/{id}',[PesanController::class,'delete']);
Route::get('/konfirmasi-check_out',[PesanController::class,'konfirmasi']);
Route::get('/profile', [ProfileController::class,'index']);
Route::post('/profile', [ProfileController::class,'update']);


