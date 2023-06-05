<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Users extends Model
{
    use HasFactory;

    protected $table ='users';

    public function getAllUsers($filters=[],$keywords=null, $sortByArr = null){

        //$users = DB::select('SELECT * FROM users ORDER BY created_at DESC');
        //DB::enableQueryLog();
        $users = DB::table($this->table)
        ->select('users.*','groups.name as group_name')
        ->join('groups','users.group_id','=','groups.id');

        $orderBy ='users.created_at';
        $orderType = 'asc';

        if(!empty($sortByArr)&& is_array($sortByArr)){
            if(!empty($sortByArr['sortBy'])&& !empty($sortByArr['sortType'])){
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }
        $users=$users->orderBy($orderBy,$orderType);
        
        if(!empty($filters)){
            $users =$users->where($filters);
        }

        if(!empty($keywords)){
            $users=$users->where(function($query) use ($keywords){
                $query->orWhere('users.name','like','%'.$keywords.'%');
                $query->orWhere('email','like','%'.$keywords.'%');
            });
        }

        $users = $users->get();
        //$sql= dd(DB::getQueryLog());
        //dd($sql);
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
        // DB::enableQueryLog();
        // lấy tất cả bản ghi của table 
        //$lists=DB::table($this->table)->get();
        // lấy email và name còn lấy tất cả thì ghi *
        //có thể thay đổi tên định danh bằng cách dùng as ví dụ name as hoten
        // $lists=DB::table($this->table)
        // ->select('email','name','id')
        // ->where('id',1)
        // ->where(function($query){
        //     $query->where('id','>',1)->orwhere('id','<',3);
        // })
        // ->get();
        // $sql= dd(DB::getQueryLog());
        // dd($sql);

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
        // ->where('id','<=',4)
        // ->orWhere('id','<=',7)
        // ->get();
        // ->toSql();
        // dd($lists);
        
        //Join table
        // DB::enableQueryLog();
        // $lists = DB::table('users')
        //->select('users.*','groups.name as group_name')
        //->join('groups','users.group_id','=','groups.id')
        // ->orderBy('id','desc')
        // ->orderBy('create_at','asc')
        // ->inRandomOrder()
        // ->select(DB::raw('count(id) as email_count'),'email','name')
        // ->groupBy('email')
        // ->groupBy('name')
        // ->having('email_count','>=',2)
        // ->limit(2)  //データが二つだけ表示
        // ->offset(1) //１設定したら、０のデータが省いて、１から表示
        //または　skip-take も同じ機能が使える。skip は offset。take は limit
        // ->get();

        // dd($lists);
        // DB::enableQueryLog();
        // $insert= DB::table('users')->insert([//insertメソッド
        //     'name'=>'Luu Bang',
        //     'email'=>'luubang12@gmail.com',
        //     'group_id'=> '2',
        //     'created_at'=>date('Y-m-d H:i:s')
        // ]);
        // $lastId=DB::getPdo()->lastInsertId(); //最後にインストールしたデータはidを取得する。
        // //最後idを取得しないと書かない
        // dd($lastId);



        // DB::enableQueryLog();
        // $update= DB::table('users')
        // ->where('id',38) //全部編集する場合、whereはいらない
        // ->update([ 
        //     'name'=>'Luu Bang2',
        //     'email'=>'luubang123@gmail.com',
        //     'group_id'=> '2',
        //     'update_at'=>date('Y-m-d H:i:s')
        // ]);
        // dd($update);
        // $sql= DB::getQueryLog();
        // dd($sql);

        // DB::enableQueryLog();
        // $delete= DB::table('users')
        // ->where('id',38) //全部削除する場合、whereはいらない。
        // //注意してください
        // ->delete();
        // dd($delete);

        //レコードを数えて、取得する。下記の場合、id > 20　のデータを数える。
        // $count=DB::table('users')->where('id', '>',20)->count();
        // dd($count);

        // DB::enableQueryLog();
        // $lists= DB::table('users')
        // // ->selectRaw('name,email,count(id)')
        // // ->groupBy('name')
        // // ->groupBy('email')
        // // ->whereRaw('id','>',[20])
        // // ->orWhereRaw('id','>',[20])
        // // ->orderByRaw('create_at DESC, update_at ASC)
        // // ->groupByRaw('email, name')
        // // ->havingRaw('count(id) > ?',[2])
        // ->where('group_id','=',)
        // ->get();

        // $sql= DB::getQueryLog();
        // dd($sql);


        //lấy 1 bản ghi đầu tiên của table(lấy thông tin chi tiết)
        // $detai= DB::table($this->table)->first();
    }
}
