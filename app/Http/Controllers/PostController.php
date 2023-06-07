<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    //
    public function index(){

        //データをすべて取得する
        // $allPosts = Post::all();

        // if ($allPosts->count()>0){
        //     foreach($allPosts as $item){
        //         echo $item->title.'<br>';
        //     }
        // }
        
        //１レコードだけ取得する。
        // $detail = Post::find(1);
        // dd($detail);

        //クエリビルダからORMに変更
        // $activePosts = Post::where('status',1)->orderBy('id','DESC')->get();
        // if($activePosts->count()>0){
        //     foreach($activePosts as $item){
        //         echo $item->title.'<br>';
        //     }
        // }

        // $allPosts = Post::all();
        // $activePosts = $allPosts->reject(function ($post) { //rejectとは合う条件を省く
        //     return $post->status==0; 
        //     }); // status==0のレコードを省く　＝＞status==0以外表示する。
        // dd($activePosts);

        $allPosts = Post::cursor();
        foreach($allPosts as $item){
            echo $item->title.'<br>';
        }
    }
    

    public function add(){
        $dataInsert = [
            'title' => 'Laravelの勉強について',
            'content' => 'Eloquent ORM の基礎',
            'status' => 1
        ];

        //$post = Post::create($dataInsert);　　//Eloquent ORM メソッド

        //$postInsert = Post::insert($dataInsert); //クリエビルダメソッド同じ

        // $post = Post::firstOrCreate([ //最初の要件をあったら、取得する。合わなかったら、挿入して、取り出す。
        //     'id'=>10  //データ確認
        // ],$dataInsert);
        
        $check =true;

        $post = new Post;
        $post->title = '新しいタイトル'; //title,content 追加
        $post->content= '新しい内容';
        if($check){ //trueだったら、status= 1
            $post->status=1;
        }
        $post->save(); // saveメソッド
    }

    public function update($id){
        $post = Post::find($id);
        // $post->title = 'update タイトル';
        // $post->content = 'update 内容';
        // $post->save();

        $dataUpdate = [
            'title' => 'update 4 タイトル',
            'content' => 'update 4 内容'
        ];
        //$status= $post->update($dataUpdate); //または下記も出来る
        // $status = Post::where('id',$id)->update($dataUpdate);

        Post::updateOrCreate([ //idがあるとupdateする。ないと作成
            'id' => 16 //条件
        ],$dataUpdate);
    }




}

