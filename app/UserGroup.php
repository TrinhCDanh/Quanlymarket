<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    //
    protected $table = "user_group";
    protected $fillable = ['id','name','status','permission'];

    public function user(){
        return $this->hasMany('App\User', 'id_group');
    }
}
