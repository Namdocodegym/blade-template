<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;
use App\Models\User;

class Country extends Model
{

    use HasFactory;
    protected $table ='country';

    public function posts(){
        return $this->hasManyThrough(
            Posts::class,
            User::
        );
    }
}
