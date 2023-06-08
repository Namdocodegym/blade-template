<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phone';
    public function user(){
        return $this->belongsTo(
            Users::class,
            'user_id',
            'id'
        );
    }
}
