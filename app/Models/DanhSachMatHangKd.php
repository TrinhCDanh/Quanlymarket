<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhSachMatHangKd extends Model
{
    //
    protected $table = 'danh_sach_mat_hang_kd';
    protected $fillable = ['id','ten','id_ho_kd','id_sap','id_co_so_cc','luong_hang_bq_nhap','id_don_vi','ghi_chu','ten_giay_chung_nhan','url_giay_chung_nhan','id_nganh_kd','ngay_dang_ky'];
    public $timestamps = false;
    public function getCoSoCungCap(){
        return $this->belongsTo('App\Models\CoSoCc','id_co_so_cc');
    }


    public function getDonViTinh(){
        return $this->belongsTo('App\Models\DonViTinh','id_don_vi');

    }

    public function getHoKinhDoanh(){
        // danh sach cac ho kinh doanh
        return $this->belongsTo('App\Models\HoKinhDoanh','id_ho_kd');
    }
    public function getSap(){
        // danh sach cac ho sap
        return $this->belongsTo('App\Models\Sap','id_sap');
    }
    public function getNganhNgheKD(){
        // danh sach cac ho sap
        return $this->belongsTo('App\Models\NganhKinhDoanh','id_nganh_kd');
    }


    public function getNganhKinhDoanh()
    {
        return $this->belongsTo('App\Models\NganhKinhDoanh','id_nganh_kd');
    }
}
