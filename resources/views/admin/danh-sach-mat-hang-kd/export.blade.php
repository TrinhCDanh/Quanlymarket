<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<style>
.center{ text-align:center; }
.bold{ font-weight: bold; }
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
        <td colspan="8" class="bold center">BẢNG KÊ KHAI CÁC MẶT HÀNG KINH DOANH TẠI CHỢ TRUYỀN THỐNG (DÀNH CHO THƯƠNG NHÂN)</td>
    </tr>
    <tr></tr>
    <tr>
        <td>Chợ: </td>
        <td>{{isset($ho_info->getCho) ? $ho_info->getCho->ten : 'N/A'}}</td>
    </tr>
    <tr>
        <td colspan="2">Số quầy kinh doanh: </td>
        <td>
            @if(isset($ho_info->getSap))
                @foreach($ho_info->getSap as $item)
                    {{$item->ten}}, 
                @endforeach
            @endif
        </td>
        <td></td>
        <td>Số GCN ĐKKD: {{$ho_info->ma_so_ho_kd}}</td>
        <td>Ngày cấp: {{!empty($ho_info->ngay_thay_doi) ? date('d/m/Y', strtotime($ho_info->ngay_thay_doi)) : ''}}</td>
    </tr>
    <tr>
        <td colspan="2">Tên chủ hộ kinh doanh: </td>
        <td colspan="2">{{$ho_info->ten_ho_kd}}</td>
        <td></td>
        <td>Điện thoại:</td>
        <td>{{$ho_info->sdt_ho_kd}}</td>
    </tr>
    <tr>
        <td colspan="2">Ngành nghề kinh doanh chính: </td>
        <td>{{isset($ho_info->getNganhKinhDoanh) ? $ho_info->getNganhKinhDoanh->ten_nganh : 'N/A'}}</td>
    </tr>
    <tr>
        <td colspan="4">
            Số giấy chứng nhận đủ điều kiện An toàn thực phẩm: {{$ho_info->ma_so_giay_ATTP}} do {{$ho_info->noi_cap_giay_ATTP}} cấp;
        </td>
        <td>
            Ngày cấp: {{!empty($ho_info->ngay_cap_giay_ATTP) ? date('d/m/Y', strtotime($ho_info->ngay_cap_giay_ATTP)) : ''}}
        </td>
        <td>Thời gian hiệu lực: </td>
        <td>{{$ho_info->thoi_gian_hieu_luc_ATTP}}</td>
    </tr>
    <tr>
        <td colspan="2">Khám sức khỏe: {{ $ho_info->kham_suc_khoe==1 ? '✓' : '-'}}</td>
        <td></td>
        <td>Giấy xác nhận kiến thức: {{ $ho_info->giay_xac_nhan_kien_thuc==1 ? '✓' : '-'}}</td>
        <td></td>
        <td>Giấy CN đủ điều kiện: {{ $ho_info->GCN_du_dieu_kien==1 ? '✓' : '-'}}</td>
        <!-- <td></td> -->
        <td>Bản cam kết đảm bảo ATTP: {{ $ho_info->ban_cam_ket_dam_bao==1 ? '✓' : '-'}}</td>
    <tr>
</table>
<table>
    <thead>
        <tr class="center">
            <th>STT</th>
            <th>Sạp</th>
            <th>Mặt hàng <br/> kinh doanh</th>
            <th>Tên cơ sở cung cấp (ghi rõ <br> số quầy, sạp chợ, tên chủ <br/> giao hàng)</th>
            <th>Địa chỉ, điện thoại <br/> cơ sở cung cấp</th>
            <th>Lượng hàng QB nhập vào chợ <br/> (theo tháng)</th>
            <th>Đơn vị <br/> tính</th>
            <th>Giấy tờ chứng minh <br/> nguồn gốc</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        @foreach($getListMatHang as $item)
        <?php $i++; ?>
        <tr>
            <td>{{ $i }}</td>
            <td>{{ isset($item->getSap) ? $item->getSap->ten : 'N/A' }}</td>
            <td>{{ $item->ten }}</td>
            <td>{{ $item->getCoSoCungCap->ten}}</td>
            <td>{{ $item->getCoSoCungCap->dia_chi}} - {{ $item->getCoSoCungCap->sdt}}</td>
            <td>{{ $item->luong_hang_bq_nhap}}</td>
            <td>{{ isset($item->getDonViTinh->ten) ? $item->getDonViTinh->ten : 'N/A'}}</td>
            <td>{{ $item->ten_giay_chung_nhan}}</td>
            <td>{{ $item->ghi_chu}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
<!-- <table>
    <tr>
        <td></td>
        <td style="font-weight:bold; font-style: italic; text-decoration: underline;">Ghi chú: </td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">1. Mặt hàng kinh doanh: ghi đầy đủ các mặt hàng hiện đang kinh doanh</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">2. Đơn vị cung cấp: ghi rõ loại hình công ty (Cty TNHH MTV, Cty TNHH, DNTN, Cty CP, HTX, HKD ...)</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">3. Giấy tờ chứng minh nguồn gốc:</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">- Hóa đơn đầu vào</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">- Sổ thú ý</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">- Hợp đồng buôn bán</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">- Khác: ..................</td>
    </tr>
</table> -->