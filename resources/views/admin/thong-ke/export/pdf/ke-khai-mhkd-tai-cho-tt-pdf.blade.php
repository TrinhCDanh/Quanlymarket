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
        $ma_so_giay_ATTP = (isset($data_search['data_ho_kinh_doanh']->ma_so_giay_ATTP)) ? $data_search['data_ho_kinh_doanh']->ma_so_giay_ATTP : "N/A";
        $noi_cap_giay_ATTP = (isset($data_search['data_ho_kinh_doanh']->noi_cap_giay_ATTP)&& $data_search['data_ho_kinh_doanh']->noi_cap_giay_ATTP != "") ? $data_search['data_ho_kinh_doanh']->noi_cap_giay_ATTP : "N/A";
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

    body {
        font-family: DejaVu Sans;
    }

    table {
        border-collapse: collapse;
    }

    table.border th, .border td {
        border: 1px solid;
        padding: 3px 5px;
    }
</style>
<div class="center">
    <strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong><br/>
    <strong>Độc lập - Tự do - Hạnh phúc
        <hr style="width: 200px"/>
    </strong><br/><br/>
    <strong>BẢNG KÊ KHAI CÁC MẶT HÀNG KINH DOANH TẠI CHỢ TRUYỀN THỐNG (DÀNH CHO THƯƠNG NHÂN)</strong>
</div>
<div>
    <p>Chợ: {{isset($ten_cho) ? $ten_cho : 'N/A'}} </p>
    <p>Số quầy kinh doanh:
        @if($data_filter)
            @foreach($ten_sap as $item)
                {{$item->ten}}
            @endforeach
        @else($data_search)
            {{$ten_sap}}
        @endif
        &nbsp;&nbsp;&nbsp;&nbsp;
        Số GCN ĐKKD: {{$ma_so_ho_kd}}
        &nbsp;&nbsp;&nbsp;&nbsp;
        Ngày cấp: {{date('d/m/Y', strtotime($ngay_thay_doi))}}
    </p>
    <p>
        Tên chủ hộ kinh doanh: {{$ten_ho_kd}}
        &nbsp;&nbsp;&nbsp;&nbsp;
        Điện thoại: {{$sdt_ho_kd}}
    </p>
    <p>Ngành nghề kinh doanh
        chính: {{isset($ten_nganh) ? $ten_nganh : 'N/A'}}</p>
    <p>
        Số giấy chứng nhận đủ điều kiện An toàn thực phẩm: {{$ma_so_giay_ATTP}} do {{$noi_cap_giay_ATTP}} cấp;&nbsp;
        Ngày cấp: {{date('d/m/Y', strtotime($ngay_cap_giay_ATTP))}}; &nbsp;
        Thời gian hết hiệu lực: {{date('d/m/Y', strtotime($thoi_gian_hieu_luc_ATTP))}}
    </p>
    <p>
        Khám sức khỏe: {{ $kham_suc_khoe==1 ? '✓' : 'x'}}
        &nbsp;&nbsp;&nbsp;&nbsp;
        Giấy xác nhận kiến thức: {{ $giay_xac_nhan_kien_thuc==1 ? '✓' : 'x'}}
        &nbsp;&nbsp;&nbsp;&nbsp;
        Giấy CN đủ điều kiện: {{ $GCN_du_dieu_kien==1 ? '✓' : 'x'}}
        &nbsp;&nbsp;&nbsp;&nbsp;
        Bản cam kết đảm bảo ATTP: {{ $ban_cam_ket_dam_bao==1 ? '✓' : 'x'}}
    </p>
    <p>
    </p>
</div>
<table class="border">
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
