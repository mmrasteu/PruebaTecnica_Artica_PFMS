<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UsuariosController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FormController::class, 'index'])->name('index');
Route::post('/request', [FormController::class, 'request'])->name('request');
Route::post('/ajax_query_comprobarnif', [UsuariosController::class, 'get_value'])->name('query_comprobar_nif');