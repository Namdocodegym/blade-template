<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function getContent(){
        $content= file_get_contents('http://loripsum.net/api');
        $content= substr($content,0,rand(5,10));
        return $content;
    }

    public function getTitle(){
        $content= file_get_contents('http://loripsum.net/api');
        $content=strip_tags($content);
        $title= substr($content,0,rand(5,10));
        return $title;
    } 

    public function run(): void
    {
        //
        for($i=1;$i<=10;$i++){
            DB::table('posts')->insert([
                'title'=>$this->getTitle(),
                'content'=>$this->getContent(),
                'status'=>rand(0,1),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')

            ]);
        }
    }
}
