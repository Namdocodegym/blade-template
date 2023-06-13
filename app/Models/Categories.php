<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;

class Categories extends Model
{
    use HasFactory;

    protected $table ="categories";

    public function posts(){
        return $this->belongsToMany(
            Posts::class,
            'categories_posts',
            'category_id',
            'post_id'
        );
    }

}
