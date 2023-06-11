<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

class Groups extends Model
{
    use HasFactory;

    protected $table = 'groups';

    public function users(){
        // return $this->hasOne(
        //     Users::class,
        //     'group_id',
        //     'id'
        // );
        return $this->hasMany(
            Users::class,
            'group_id',
            'id'
        );
    }
    
    public function getAll()
    {
        $groups = DB::table($this->table)
        ->orderBy('name','ASC')
        ->get();

        return $groups;
    }
}
