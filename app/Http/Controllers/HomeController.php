<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class HomeController extends Controller
{
    public $data =[];
    public function index(){
       $this->data['title'] = 'Laravel';

        return view('clients.home',$this->data);
    }

    public function products(){
        $this->data['title'] ='product';

        return view('clients.products',$this->data);
    }

    public function getAdd(){
        $this->data['title'] ='add product';
        $this->data['errorMessage']='入力エラー';
        return view('clients.add',$this->data);
    }

    // public function postAdd(Request $request){
    public function postAdd(ProductRequest $request){
        // $rules=[
        //     // bắt buộc nhập là required
        //     'product_name' => 'required | min:6',
        //     'product_price' => 'required | integer',
        // ];

        // $messages =[
        //      //trong trường hợp muốn hiển thị tên tự động thì dùng :attribute 入力してください
        //      'product_name.required' => '品名入力してください',
        //      'product_name.min' => '入力 :min 桁以上',
        //      'product_price.required'=>'値段入力してください' ,

        //      //có thể viết mà không cần tên trường(với trường hợp trùng required thì cũng dùng :attribute để hiển thị)
        //      // 'required' => ' :attribute 入力してください',
        //      'integer'=>'数字入力してください'
        // ];

        // $request->validate($rules,$messages);
    }


    public function dowloadImage(Request $request){
        if(!empty($request->image)){
            $image=trim($request->image);

            //tự động lưu tên ảnh bất kỳ
            $fileName= basename($image);

            return response()->streamDownload(function() use ($image){
                $imageContent = file_get_contents($image);
                echo $imageContent;
            },$fileName);
        }

            
    }
}