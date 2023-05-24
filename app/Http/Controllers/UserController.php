<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    public function index(){
        $title ='ユーザ一覧';
        

        $users = DB::select('SELECT * FROM users');

        return view('clients.users.lists',compact('title','users'));

    }
}