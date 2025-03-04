<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartSoilController;

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
    return view('/home');//ubah ke 'welcome'untuk tampilan login auth
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/smartsoil', [App\Http\Controllers\HomeController::class, 'Smart_Soil'])->name('smartsoil');
//Route::get('/smart-soil', [HomeController::class, 'Smart_Soil']);
Route::get('/smartirrigation', [App\Http\Controllers\HomeController::class, 'Smart_Irrigation'])->name('smartirrigation');
Route::get('/smartweather', [App\Http\Controllers\HomeController::class, 'Smart_Weather'])->name('smartweather');

