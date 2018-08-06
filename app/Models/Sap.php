<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sap extends Model
{
    //
    protected $table = 'sap';
    protected $fillable = ['id','ma_so_sap','ten','id_ho_kinh_doanh','id_cho','delete_at'];
    public $timestamps = false;

    public function hoKinhDoanh(){
        return $this->belongsTo('App\Models\HoKinhDoanh','id_ho_kinh_doanh');
    }

    public function cho(){
        return $this->belongsTo('App\Models\Cho','id_cho');
    }

  /*  public function getDanhSachMatHangKinhDoanh(){
        return $this->hasMany('App\Models\DanhSachMatHangKd','id_sap');
    }*/
}
