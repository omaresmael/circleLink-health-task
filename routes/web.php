<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PatientController::class,'index'])->name('patient.index');
Route::get('/patient/create', [PatientController::class,'create'])->name('patient.create');
Route::get('patient/export', [PatientController::class,'export'])->name('patient.export');
