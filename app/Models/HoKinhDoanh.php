<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoKinhDoanh extends Model
{
    //
   // protected $primaryKey = 'id';
    protected $table = 'ho_kinh_doanh';
    protected $fillable = [
        "ma_so_ho_kd" ,
        "ten_ho_kd",
        "id_cho",
        "tang" ,
        "sdt_ho_kd" ,
        "fax_ho_kd" ,
        "email_ho_kd",
        "website" ,
        "id_nganh_kd" ,
        "von_kd" ,
        "ho_chu_ho_kd",
        "ten_chu_ho_kd",
        "gioi_tinh",
        "ngay_sinh",
        "dan_toc",
        "quoc_tich",
        "sdt_chu_ho_kd",
        "loai_giay_to",
        "ma_so_giay_to",
        "ngay_cap_giay_to",
        "noi_cap",
        "dia_chi_thuong_tru",
        "dia_chi_tam_tru" ,
        "ngay_dang_ki_1st",
        "so_lan_thay_doi" ,
        "ngay_thay_doi",
        "giay_ATTP_Status",
        "ma_so_giay_ATTP",
        "thoi_gian_hieu_luc_ATTP",
        "nguoi_cap",
        "noi_cap_giay_ATTP",
        "File_Upload",
        "kham_suc_khoe",
        "giay_xac_nhan_kien_thuc",
        "GCN_du_dieu_kien",
        "ban_cam_ket_dam_bao",
        "ngay_cap_giay_GCNDKKD",
        "so_lao_dong"

    ];
    public $timestamps = false;

    public function getSap(){
        // danh sach cac sap
        return $this->hasMany('App\Models\Sap','id_ho_kinh_doanh');
    }
    public function getDanhSachMatHangKinhDoanh(){
        return $this->hasMany('App\Models\DanhSachMatHangKd','id_ho_kd');
    }
    public function  getCho(){
        return $this->belongsTo('App\Models\Cho','id_cho');
    }
    public function getNganhKinhDoanh(){
        return $this->belongsTo('App\Models\NganhKinhDoanh','id_nganh_kd');
    }


}
