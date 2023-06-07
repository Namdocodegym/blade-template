<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Quy ước tên table
    /*
    tên table: Post -> table:posts
    tên model: ProductCategory-> product_categories
    */

    protected $table = 'posts';

    //quy ước khóa chính: mặc định laravel field id làm khóa chính

    protected $primaryKey = 'id';

    public $timestamps = true;

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $attributes = [
        'status' => 0
    ];

    protected $fillable = ['title', 'content', 'status'];
}
