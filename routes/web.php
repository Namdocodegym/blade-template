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

    $post = Posts::find(1);

    $post->comments()->create([
        'name' =>'Van Quan 3',
        'content' =>'comment 8'
    ]);

    // $post->comments()->saveMany([
    //     new Comments([
    //         'name' =>'Van Quan 1',
    //         'content' =>'comment 6'
    //     ]),
    //     new Comments([
    //         'name' =>'Van Quan 2',
    //         'content' =>'comment 7'
    //     ])
    // ]); // dùng khi muốn thêm nhiều mảng thông tin.

    // $comment = new Comments([
    //     'name' =>'Van Quan',
    //     'content' =>'comment 5'
    // ]);
    // $post->comments()->save($comment); //cap nhat,them 1 du lieu 

    // $users = Users::with(['group'=>function($query){
    //     $query->where('id','>',1);
    // }])->get(); //tai du lieu 1 lan and them rang buoc function

    // foreach ($users as $user){ //loc qua tung giu lieu
    //     if(!empty($user->group->name)){  
    //         echo $user->group->name.'<br/>';
    //     }
    // }


    // $users = Users::all(); //lay tat ca du lieu

    // foreach ($users as $user){ //loc qua tung giu lieu
    //     if(!empty($user->group->name)){  
    //         echo $user->group->name.'<br/>';
    //     }
    // }
    // $posts = Posts::withCount(['comments','votes as likes'=>function($query){
    //     $query->where('value','>',0);
    // }])->get();
    // dd($posts);
    // $post = Posts::has('comments')->get();  最低１コメント
    // $post = Posts::whereHas('comments','>=',2)->get(); //whereHas 条件
    // $post = Posts::whereHas('comments',function($query){
    //     $query->whereNotNull('image');
    // })->get(); //tra ve it nhat 1 comment va co chua img
    // $post = Posts::doesntHave('comments')->get();
    // dd($post); 
    // $users = Groups::find(1);
    // $users = $users->users;
    // dd($users);
    // $phone = User::find(4)->phone;
    // dd($phone);
    // $owner = Mechanics::find(1)->carOwner;
    // dd($owner);
    // $posts = Country::find(2)->posts;
    // dd($posts);
    // $posts = Categories::find('1')->posts;
    // dd($posts);
    // $categories = Posts::find(2)->categories;
    // foreach($categories as $category){
    //     // if(!empty($category->pivot->created_at)){
    //     //     echo $category->pivot->created_at;
    //     // }
    //     // dd($category->pivot);
    //     echo $category->pivot->post_id.'-';
    //     echo $category->pivot->status;
    // }
});