<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('clients.add',$this->data);
    }

    public function postAdd(Request $request){
        $request->validate([
            // bắt buộc nhập là required
            'product_name' => 'required | min:6',
            'product_price' => 'required | integer',
        ]);
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