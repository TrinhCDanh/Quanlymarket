<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cho extends Model
{
    //
    protected $table = 'cho';
    protected $fillable = ['id','ten','dia_chi'];
    public $timestamps = false;

      public function getHoKinhDoanh(){
        // danh sach cac ho kinh doanh
        return $this->hasMany('App\Models\HoKinhDoanh','id_cho');
    }
    public function getLogHoKinhDoanh(){
        // danh sach log cac ho kinh doanh
        return $this->hasMany('App\Models\LogHoKinhDoanh','id_cho');
    }
    


}
