<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NganhKinhDoanh extends Model
{
    //
    protected $table = 'nganh_kd';
    protected $fillable = ['id','ten_nganh'];
    public $timestamps = false;


    public function getHoKinhDoanh(){
        // danh sach cac ho kinh doanh
        return $this->belongsTo('App\Models\HoKinhDoanh','id_ho_kd');
    }
    public function getSap()
    {
        // danh sach cac ho kinh doanh
        return $this->belongsTo('App\Models\Sap', 'id_sap');
    }
    public function getDanhSachMatHang()
    {
    	$this->hashMany('App\Models\DanhSachMatHangKd','id_nganh_kd');
    }
}

