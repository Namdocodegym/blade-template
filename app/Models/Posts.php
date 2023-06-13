<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\Votes;

class Posts extends Model
{
    use HasFactory;

    protected $table ='posts';

    public function categories(){
        return $this->belongsToMany(
            Categories::class,
            'categories_posts',
            'post_id',
            'category_id'
        )
        ->withPivot('created_at','status')
        ->wherePivot('status',1);
        // ->withTimestamps(); //careated_at and update_at 
    }

    public function comments(){
        return $this->hasMany(
            Comments::class,
            'post_id',
            'id'
        );
    }

    public function votes(){
        return $this->hasMany(
            Votes::class,
            'post_id',
            'id'
        );
    }
}
