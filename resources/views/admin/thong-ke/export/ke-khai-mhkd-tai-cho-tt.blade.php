@php
    $ten_sap = '';
    $ten_cho = '';
    $tang = '';
    $ten_ho_kd = '';
    $sdt_ho_kd = '';
    $ma_so_ho_kd = '';
    $ma_so_giay_ATTP = '';
    $noi_cap_giay_ATTP = '';
    $ngay_thay_doi = '';
    $ngay_cap_giay_ATTP = '';
    $kham_suc_khoe = '';
    $giay_xac_nhan_kien_thuc = '';
    $thoi_gian_hieu_luc_ATTP = '';
    $GCN_du_dieu_kien = '';
    $ban_cam_ket_dam_bao = '';
    $ten_nganh = '';
@endphp
@if(isset($data_search) ? $data_search : "")
    @php
        $ten_sap = (isset($data_search['data_sap']->ten)) ? $data_search['data_sap']->ten : "N/A";
        $ten_cho = (isset($data_search['data_cho']->ten)) ? $data_search['data_cho']->ten : "N/A";
        $tang = (isset($data_search['data_ho_kinh_doanh']->tang)) ? $data_search['data_ho_kinh_doanh']->tang : "N/A";
        $ten_ho_kd = (isset($data_search['data_ho_kinh_doanh']->ten_ho_kd)) ? $data_search['data_ho_kinh_doanh']->ten_ho_kd : "N/A";
        $sdt_ho_kd = (isset($data_search['data_ho_kinh_doanh']->sdt_ho_kd)) ? $data_search['data_ho_kinh_doanh']->sdt_ho_kd : "N/A";
        $ma_so_ho_kd = (isset($data_search['data_ho_kinh_doanh']->ma_so_ho_kd)) ? $data_search['data_ho_kinh_doanh']->ma_so_ho_kd : "N/A";
        $ma_so_giay_ATTP = (isset($data_search['data_ho_kinh_doanh']->ma_so_giay_ATTP) && $data_search['data_ho_kinh_doanh']->ma_so_giay_ATTP != "") ? $data_search['data_ho_kinh_doanh']->ma_so_giay_ATTP : "N/A";
        $noi_cap_giay_ATTP = (isset($data_search['data_ho_kinh_doanh']->noi_cap_giay_ATTP) && $data_search['data_ho_kinh_doanh']->noi_cap_giay_ATTP != "") ? $data_search['data_ho_kinh_doanh']->noi_cap_giay_ATTP : "N/A";
        $ngay_thay_doi = (isset($data_search[''])) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_search['data_ho_kinh_doanh']->ngay_thay_doi)->format('d-m-Y') : "N/A";
        $ngay_cap_giay_ATTP = (isset($data_search['data_ho_kinh_doanh']->ngay_cap_giay_ATTP)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_search['data_ho_kinh_doanh']->ngay_cap_giay_ATTP)->format('d-m-Y') : "N/A";
        $kham_suc_khoe = (isset($data_search['data_ho_kinh_doanh']->kham_suc_khoe)) ? $data_search['data_ho_kinh_doanh']->kham_suc_khoe : "-";
        $giay_xac_nhan_kien_thuc = (isset($data_search['data_ho_kinh_doanh']->giay_xac_nhan_kien_thuc)) ? $data_search['data_ho_kinh_doanh']->giay_xac_nhan_kien_thuc : "N/A";
        $thoi_gian_hieu_luc_ATTP = (isset($data_search['data_ho_kinh_doanh']->thoi_gian_hieu_luc_ATTP)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_search['data_ho_kinh_doanh']->thoi_gian_hieu_luc_ATTP)->format('d-m-Y') : "N/A";
        $GCN_du_dieu_kien = (isset($data_search['data_ho_kinh_doanh']->GCN_du_dieu_kien)) ? $data_search['data_ho_kinh_doanh']->GCN_du_dieu_kien : "N/A";
        $ban_cam_ket_dam_bao = (isset($data_search['data_ho_kinh_doanh']->ban_cam_ket_dam_bao)) ? $data_search['data_ho_kinh_doanh']->ban_cam_ket_dam_bao : "N/A";
        $ten_nganh = (isset($data_search['data_nganh_kinh_doanh']->ten_nganh)) ? $data_search['data_nganh_kinh_doanh']->ten_nganh : "N/A";
    @endphp
@endif

@if(isset($data_filter) ? $data_filter : "")
    @php
        $ten_cho = (isset($data_filter['data_cho']->ten)) ? $data_filter['data_cho']->ten : "N/A";
        $ten_sap = (isset($data_filter['data_sap'])) ? $data_filter['data_sap'] : "N/A";
        $tang = (isset($data_filter['data_ho_kinh_doanh']->tang)) ? $data_filter['data_ho_kinh_doanh']->tang : "N/A";
        $ten_ho_kd = (isset($data_filter['data_ho_kinh_doanh']->ten_ho_kd)) ? $data_filter['data_ho_kinh_doanh']->ten_ho_kd : "N/A";
        $sdt_ho_kd = (isset($data_filter['data_ho_kinh_doanh']->sdt_ho_kd)) ? $data_filter['data_ho_kinh_doanh']->sdt_ho_kd : "N/A";
        $ma_so_ho_kd = (isset($data_filter['data_ho_kinh_doanh']->ma_so_ho_kd)) ? $data_filter['data_ho_kinh_doanh']->ma_so_ho_kd : "N/A";
        $ma_so_giay_ATTP = (isset($data_filter['data_ho_kinh_doanh']->ma_so_giay_ATTP)) ? $data_filter['data_ho_kinh_doanh']->ma_so_giay_ATTP : "N/A";
        $noi_cap_giay_ATTP = (isset($data_filter['data_ho_kinh_doanh']->noi_cap_giay_ATTP) && $data_filter['data_ho_kinh_doanh']->noi_cap_giay_ATTP != "") ? $data_filter['data_ho_kinh_doanh']->noi_cap_giay_ATTP : "N/A";
        $ngay_thay_doi = (isset($data_filter[''])) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_filter['data_ho_kinh_doanh']->ngay_thay_doi)->format('d-m-Y') : "-";
        $ngay_cap_giay_ATTP = (isset($data_filter['data_ho_kinh_doanh']->ngay_cap_giay_ATTP)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_filter['data_ho_kinh_doanh']->ngay_cap_giay_ATTP)->format('d-m-Y') : "N/A";
        $kham_suc_khoe = (isset($data_filter['data_ho_kinh_doanh']->kham_suc_khoe)) ? $data_filter['data_ho_kinh_doanh']->kham_suc_khoe : "N/A";
        $giay_xac_nhan_kien_thuc = (isset($data_filter['data_ho_kinh_doanh']->giay_xac_nhan_kien_thuc)) ? $data_filter['data_ho_kinh_doanh']->giay_xac_nhan_kien_thuc : "N/A";
        $thoi_gian_hieu_luc_ATTP = (isset($data_filter['data_ho_kinh_doanh']->thoi_gian_hieu_luc_ATTP)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_filter['data_ho_kinh_doanh']->thoi_gian_hieu_luc_ATTP)->format('d-m-Y') : "N/A";
        $GCN_du_dieu_kien = (isset($data_filter['data_ho_kinh_doanh']->GCN_du_dieu_kien)) ? $data_filter['data_ho_kinh_doanh']->GCN_du_dieu_kien : "N/A";
        $ban_cam_ket_dam_bao = (isset($data_filter['data_ho_kinh_doanh']->ban_cam_ket_dam_bao)) ? $data_filter['data_ho_kinh_doanh']->ban_cam_ket_dam_bao : "N/A";
        $ten_nganh = (isset($data_filter['data_nganh_kinh_doanh']->ten_nganh)) ? $data_filter['data_nganh_kinh_doanh']->ten_nganh : "N/A";
    @endphp
@endif
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<style>
    .center {
        text-align: center;
    }

    .bold {
        font-weight: bold;
    }
</style>
<table>
    <tr>
        <td colspan="8" class="bold center">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
    </tr>
    <tr>
        <td colspan="8" class="bold center">Độc lập - Tự do - Hạnh phúc</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="8" class="bold center">BẢNG KÊ KHAI CÁC MẶT HÀNG KINH DOANH TẠI CHỢ TRUYỀN THỐNG</td>
    </tr>
    <tr></tr>
    <tr>
        <td>Chợ:</td>
        <td>{{isset($ten_cho) ? $ten_cho : 'N/A'}}</td>
    </tr>
    <tr>
        <td colspan="3">Số quầy kinh doanh:</td>
        <td>

            @if($data_filter)
                @foreach($ten_sap as $item)
                    {{$item->ten}}
                @endforeach
            @else($data_search)
                {{$ten_sap}}
            @endif
        </td>
        <td></td>
        <td>Số GCN ĐKKD: {{$GCN_du_dieu_kien}}</td>
        <td>Ngày cấp: {{date('d/m/Y', strtotime($ngay_thay_doi))}}</td>
    </tr>
    <tr>
        <td colspan="3">Tên chủ hộ kinh doanh:</td>
        <td colspan="2">{{$ten_ho_kd}}</td>
        <td></td>
        <td>Điện thoại:</td>
        <td>{{$sdt_ho_kd}}</td>
    </tr>
    <tr>
        <td colspan="3">Ngành nghề kinh doanh chính:</td>
        <td>{{isset($ten_nganh) ? $ten_nganh : 'N/A'}}</td>
    </tr>
    <tr>
        <td colspan="4">
            Số giấy chứng nhận đủ điều kiện An toàn thực phẩm: {{isset($ma_so_giay_ATTP) ? $ma_so_giay_ATTP : 'N/A'}}
            do {{isset($noi_cap_giay_ATTP) ? $noi_cap_giay_ATTP : 'N/A'}} cấp;

        </td>
        <td>
            Ngày cấp: {{date('d/m/Y', isset($ngay_cap_giay_ATTP) ? strtotime($ngay_cap_giay_ATTP) : 'N/A')}}
        </td>
        <td>Thời gian hết hiệu lực:</td>
        <td>{{$thoi_gian_hieu_luc_ATTP}}</td>
    </tr>
    <tr>
        <td colspan="2">Khám sức khỏe: {{ $kham_suc_khoe==1 ? '✓' : '-'}}</td>
        <td></td>
        <td>Giấy xác nhận kiến thức: {{ $giay_xac_nhan_kien_thuc==1 ? '✓' : '-'}}</td>
        <td></td>
        <td>Giấy CN đủ điều kiện: {{ $GCN_du_dieu_kien==1 ? '✓' : '-'}}</td>
        <!-- <td></td> -->
        <td>Bản cam kết đảm bảo ATTP: {{ $ban_cam_ket_dam_bao==1 ? '✓' : '-'}}</td>
    <tr>
</table>
<table>
    <thead>
    <tr class="center">
        <th style="text-align: center">STT</th>
        <th style="text-align: center">Sạp</th>
        <th style="text-align: center">Mặt hàng kinh doanh</th>
        <th style="text-align: center">Tên cơ sở cung cấp</th>
        <th style="text-align: center">Địa chỉ</th>
        <th style="text-align: center">Số điện thoại</th>
        <th style="text-align: center">Lượng hàng</th>
        <th style="text-align: center">Đơn vị tính</th>
        <th style="text-align: center">Giấy tờ chứng minh nguồn gốc</th>
        <th style="text-align: center">Ghi chú</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0; ?>
    @foreach($list as $item)
        <?php $i++;
        $id_co_so = $item->id_co_so_cc;
        $id_ho_kd = $item->listHoKinhDoanh;
        ?>
        <tr>
            <td style="text-align: center">{{ $i }}</td>
            <td style="text-align: center">{{$item->ma_sap}}</td>
            <td style="text-align: center">{{$item->ten}}</td>
            <td style="text-align: center">{{$id_co_so->ten}}</td>
            <td style="text-align: center">{{$id_co_so->dia_chi}}</td>
            <td style="text-align: center">{{$id_co_so->sdt}}</td>
            <td style="text-align: center">{{$item->luong_hang_bq_nhap}}</td>
            <td style="text-align: center">{{$item->dv_tinh}}</td>
            <td style="text-align: center">{{$item->ten_giay_chung_nhan}}</td>
            <td style="text-align: center">{{$item->ghi_chu}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>