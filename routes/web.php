<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class,'index'] )->name('home');

Route::get('/products',[HomeController::class,'products'])->name('product');

Route::get('/add',[HomeController::class,'getAdd' ])->name('add');

Route::post('/add',[HomeController::class,'postAdd']);

Route::get('download-image',[HomeController::class,'dowloadImage'])->name('download-image');