<?php

use App\Http\Controllers\AbsenController;
use App\Models\Absen;
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
    $absen = Absen::orderBy('id', 'DESC')->get();

    return view('welcome', compact('absen'));
});

Route::resource('/absen', AbsenController::class);
