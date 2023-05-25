<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Users extends Model
{
    use HasFactory;

    protected $table ='';

    public function getAllUsers(){

        $users = DB::select('SELECT * FROM users ORDER BY created_at DESC');

        return $users;
    }

    public function addUsers($data){
        DB::insert('INSERT INTO users (name,email,created_at) values (?,?,?)', $data );
        
    }
}
