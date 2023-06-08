<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\Phone;
use App\Models\Groups;
use App\Http\Requests\UserRequest;


use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    private $users;

    const _PER_PAGE =4;
    public function __construct()
    {
        $this->users = new Users();
    }
    public function index(Request $request){
        $title ='ユーザ一覧';

        //$statement = $this->users->statementUser("SELECT * FROM users");
        
        //$this->users->learnQueryBuilder();

        
        $filters=[];
        $keywords = null;

        if(!empty($request->status)){
            $status = $request->status;
            if($status=='active'){
                $status = 1;

            }else{
                $status=0;
            }
            $filters[]=['users.status','=',$status];

        }

        if(!empty($request->group_id)){
            $groupId = $request->group_id;
            
            $filters[]=['users.group_id','=',$groupId];

        }

        if(!empty($request->keywords)){
            $keywords = $request->keywords;
            
        }

        //xử lý logic
        $sortBy = $request->input('sortBy');
        $sortType = $request->input('sortType');

        $allowSort = ['asc','desc'];

        if(!empty($sortType)&& in_array($sortType,$allowSort)){
            if($sortType=='asc'){
                $sortType = 'desc';
            }else{
                $sortType = 'asc';
            }
        }else{
            $sortType = 'desc';
        }

        $sortArr =[
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];
            $usersList = $this->users->getAllUsers($filters,$keywords,$sortArr,self::_PER_PAGE); // const _PER_PAGE = 4;
        return view('clients.users.lists',compact('title','usersList','sortType'));

    }

    public function add(Request $request){
        $title ='ユーザ登録';
        $allGroups =getAllGroups();

        return view('clients.users.add',compact('title','allGroups'));
    }

    public function postAdd(UserRequest $request){

            $dataInsert = [
                'name' => $request->name,
                'email' => $request->email,
                'group_id' => $request->group_id,
                'status' => $request->status,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->users->addUser($dataInsert);

            return redirect()->route('users.index')->with('msg','登録完了しました');
            // chuyển hướng đến trang index và hiển thị thông báo thành công
    }

    public function getEdit(Request $request ,$id=0){
        $title ='編集';
        $allGroups =getAllGroups();

        if(!empty($id)){
            $userDetail = $this->users->getDetail($id);
            if(!empty($userDetail[0])){
                $request->session()->put('id',$id);
                $userDetail = $userDetail[0];

            }else{
                return redirect()->route('users.index')->with('msg','ユーザ存在しない');
            }
        }else{
            return redirect()->route('users.index')->with('msg','存在しない');
        }

        return view('clients.users.edit',compact('title','userDetail','allGroups'));
    }

    public function postEdit(UserRequest $request){
        $id = session('id');
        if(empty($id)){
            return back()->with('smg','存在してない');
        }
            $dataUpdate = [
                'name' => $request->name,
                'email' => $request->email,
                'group_id' => $request->group_id,
                'status' => $request->status,
                'update_at' => date('Y-m-d H:i:s')
            ];

            $this->users->updateUser($dataUpdate,$id);

            return back()->with('msg','更新しました');
    }

    public function delete($id=0){
        if(!empty($id)){
            $userDetail = $this->users->getDetail($id);
            if(!empty($userDetail[0])){
                $deleteStatus = $this->users->deleteUser($id);
                if($deleteStatus){
                    $msg='削除しました';
                }else{
                    $msg='削除できません！しばらく再削除してください';
                }
            }else{
                $msg='ユーザ存在しない';
            }
        }else{
            $msg='存在しない';
        }

        return redirect()->route('users.index')->with('msg',$msg);
    }

    public function relations(){
        //持っているidから取得
        // $phone = Users::find(40)->phone;
        // $idPhone = $phone->id;
        // $phoneNumber = $phone->phone;
        // echo 'id phone:'.$idPhone.'<br>';
        // echo 'phone number:'.$phoneNumber.'<br>';

        // $phone = Users::find(40)->phone();
        //dd($phone)

        //phoneから情報を調べて、取得する。
        // $user = Phone::where('phone','012345678')->first()->user;
        // $fullName = $user->name;
        // $email = $user->email;

        // echo 'fullName:'.$fullName.'<br>';
        // echo 'email:'.$email;

        // $users= Groups::find(1)->users()->where('id','>=',5)->get();
        // if($users->count()>0){
        //     foreach($users as $item){
        //         echo $item->name.'<br>';
        //     }
        // }

        $group = Users::find(4)->group;
        $groupName = $group->name;
        dd($groupName);

    }
}
