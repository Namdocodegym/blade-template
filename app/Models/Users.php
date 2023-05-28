<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Users extends Model
{
    use HasFactory;

    protected $table ='users';

    public function getAllUsers(){

        $users = DB::select('SELECT * FROM users ORDER BY created_at DESC');

        return $users;
    }

    public function addUser($data){
        DB::insert('INSERT INTO users (name,email,created_at) values (?,?,?)', $data );
        
    }

    public function getDetail($id){
        return DB::select('SELECT * FROM users WHERE id = ?', [$id]);
        
    }

    public function updateUser($data,$id){
        $data[] = $id;
        return DB::update('UPDATE users SET name = ?,email =?,update_at=? where id = ?', $data);
    }

    public function deleteUser($id){
        return DB::delete('DELETE FROM users WHERE id = ?', [$id]);
    }

    public function statementUser($sql){
        return DB::statement($sql);
    }

    public function learnQueryBuilder(){
        // lấy tất cả bản ghi của table 
        //$lists=DB::table($this->table)->get();
        // lấy email và name còn lấy tất cả thì ghi *
        //có thể thay đổi tên định danh bằng cách dùng as ví dụ name as hoten
        $lists=DB::table($this->table)
        ->select('email','name')
        //->where('id',1)  điều kiện =
        //->where('id','>',2) //khi điều kiện là lớn hơn 2 ngoài ra còn <,<=,>=,<> ...
        //kết hợp and và or
        // trường hợp and thì chỉ cần viết 2 câu lệnh ->where là ok
        // ->where('id','>=',2)
        // ->where('id','<=',4)
        // hoặc viết theo dạng mảng 
        // ->where([
        //     'id','>=',2
        // ],
        // [
        //     'id','<=',4
        // ])
        // trường hợp or
        ->where('id','<=',4)
        ->orWhere('id','<=',7)
        ->get();

        //lấy 1 bản ghi đầu tiên của table(lấy thông tin chi tiết)
        $detai= DB::table($this->table)->first();
    }
}
