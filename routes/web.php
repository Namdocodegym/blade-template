<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\PostController;
use App\Models\Categories;
use App\Models\Mechanics;
use App\Models\Country;
use App\Models\Posts;
use App\Models\User;
use App\Models\Users;
use App\Models\Groups;
use App\Models\Comments;


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

Route::prefix('users')->name('users.')->group(function(){
    Route::get('/',[UserController::class,'index'])->name('index');
    Route::get('/add',[UserController::class,'add'])->name('add');
    Route::post('/add',[UserController::class,'postAdd'])->name('post-add');
    Route::get('/edit/{id}',[UserController::class,'getEdit'])->name('edit');
    Route::post('/update',[UserController::class,'postEdit'])->name('post-edit');
    Route::get('/delete/{id}',[UserController::class,'delete'])->name('delete');
    Route::get('/hoc-relation',[UserController::class,'relations']);
});

Route::prefix('posts')->name('posts.')->group(function(){
    Route::get('/',[PostController::class,'index'])->name('index');
    Route::get('/add',[PostController::class,'add'])->name('add');
    Route::get('/update/{id}',[PostController::class,'update'])->name('update');
    Route::get('/delete/{id}',[PostController::class,'delete'])->name('delete');
    Route::post('/delete-any',[PostController::class,'handleDeleteAny'])->name('delete-any');
    Route::get('/restore/{id}',[PostController::class,'restore'])->name('restore');
    Route::get('/force-delete/{id}',[PostController::class,'forceDelete'])->name('force-delete');
});

Route::get('/',function(){

    
});