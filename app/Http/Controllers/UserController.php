<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;


use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new Users();
    }
    public function index(){
        $title ='ユーザ一覧';

        

        $usersList = $this->users->getAllUsers();

        return view('clients.users.lists',compact('title','usersList'));

    }

    public function add(Request $request){
        $title ='ユーザ登録';

        return view('clients.users.add',compact('title'));
    }

    public function postAdd(Request $request){
        $request->validate( 
            [ 
                'fullname' => 'required | min:5',
                'email'=> 'required |email |unique:users'
                // unique dùng để kiểm tra xem dữ liệu nhập có bị trùng lặp hay không
                //users là nơi chứa dữ liệu

            ],[
                'fullname.required'=>'名前入力してください',
                'fullname.min' => '名前５桁以上入力してください',
                'email.required'=>'email 入力してください',
                'email.email'=>'email正しく入力してください',
                'email.unique'=>'email存在しています'
            ]
            );

            $dataInsert = [
                $request->fullname,
                $request->email,
                date('Y-m-d H:i:s')
            ];

            $this->users->addUsers($dataInsert);

            return redirect()->route('users.index')->with('msg','登録完了しました');
            // chuyển hướng đến trang index và hiển thị thông báo thành công
    }
}