<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogHoKinhDoanh extends Model
{
    protected $table = 'ho_kinh_doanh_log_detail';
    protected $fillable = [
        "id_ho_kinh_doanh",
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
        "ngay_cap_giay_GCNDKKD"

    ];
    public $timestamps = false;
}
