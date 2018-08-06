<html>
<tr>
    <td style="text-align: center; font-weight: bold;" colspan="3">ỦY BAN NHÂN DÂN QUẬN 5</td>
    @for($i=0;$i < 5;$i++)
        <td></td>
    @endfor
    <td style="text-align: center; font-weight: bold;" colspan="3">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
</tr>
<tr>

    <td style="text-align: center; font-weight: bold;" colspan="3">PHÒNG KINH TẾ</td>
    @for($i=0;$i < 5;$i++)
        <td></td>
    @endfor
    <td style="text-align: center; font-weight: bold" colspan="3">Độc lập - Tự do - Hạnh phúc</td>
</tr>
<tr>
    <td colspan="11"><h3 style="text-align: center;">Quản Lý Hộ Kinh Doanh</h3></td>
</tr>
<table>
    <thead >
    <tr>
        <th>Số Hộ KD</th>
        <th>Tên hộ kinh doanh
        <th>Chợ</th>
        <th>Sạp</th>
        <th>Địa điểm KD</th>
        <th>Ngành nghề</th>
        <th>Số điện thoại</th>
        <th>Fax</th>
        <th>Email</th>
        <th>Website</th>
        <th>Họ và Tên người đại diện</th>
        <th>Địa chỉ thường trú</th>
        <th>Loại giấy tờ CTCN</th>
        <th>Số giấy tờ</th>
        <th>Ngày cấp</th>
        <th>Nơi cấp</th>
    </tr>

    </thead>
    <tbody>

    @if(isset($list))
        @foreach($list as $item)
            <tr>
                @php $ma_ho_kd = ''.isset($item->ma_so_ho_kd)? (string)($item->ma_so_ho_kd) : "-";
                $ngay_cap_giay_to = isset($item->ngay_cap_giay_to) ?  \Carbon\Carbon::createFromFormat('Y-m-d',$item->ngay_cap_giay_to)->format('d-m-Y') : "-";
                @endphp

                <td style="text-align: center">{{$ma_ho_kd." "}}</td>
                <td style="text-align: center">{{isset($item->ten_ho_kd)? $item->ten_ho_kd : "-"}}</td>
                <td style="text-align: center">{{isset($item->id_cho->ten) ? $item->id_cho->ten : "-"}}</td>
                <td style="text-align: center">{{isset($item->ma_sap) ? $item->ma_sap : "-"}}</td>
                <td style="text-align: center">{{isset($item->id_cho->dia_chi) ? $item->id_cho->dia_chi : "-"}}</td>
                <td style="text-align: center">{{isset($item->id_nganh_kd)? $item->id_nganh_kd : "-"}}</td>
                <td style="text-align: center">{{isset($item->sdt_ho_kd)? $item->sdt_ho_kd : "-"}}</td>
                <td style="text-align: center">{{isset($item->fax_ho_kd)? $item->fax_ho_kd : "-"}}</td>
                <td style="text-align: center">{{isset($item->email_ho_kd)? $item->email_ho_kd : "-"}}</td>
                <td style="text-align: center">{{isset($item->website)? $item->website:"-"}}</td>
                @if(isset($item->ho_chu_ho_kd) || ($item->ten_chu_ho_kd) )
                    <td style=" text-align: center">{{$item->ho_chu_ho_kd}} {{$item->ten_chu_ho_kd}}</td>
                @else
                    <td style="text-align: center">-</td>
                @endif
                <td style="text-align: center">{{isset($item->dia_chi_thuong_tru) ? $item->dia_chi_thuong_tru : "-"}}</td>
                @if($item->loai_giay_to == 1)
                    <td style="text-align: center">Chứng Minh Nhân Dân</td>
                @elseif($item->loai_giay_to == 2)
                    <td style="text-align: center">Căn Cước Công Dân</td>
                @else
                    <td>-</td>
                @endif
                <td style="text-align: center">{{isset($item->ma_so_giay_to) ? $item->ma_so_giay_to : "-"}}</td>
                <td style="text-align: center">{{$ngay_cap_giay_to}}</td>
                <td style="text-align: center">{{isset($item->noi_cap) ? $item->noi_cap : "-"}}</td>
            </tr>

        @endforeach
    @endif

    </tbody>

</table>
</html>