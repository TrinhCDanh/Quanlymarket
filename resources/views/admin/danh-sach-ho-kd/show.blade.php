@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Xem Hộ Kinh Doanh
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form action="{{ route('admin.ho_kinh_doanh.show',['id'=>$data->id]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="box box-solid box-primary">
                            <!-- .box-header -->
                            <div class="box-header">
                                <h3 class="box-title">Thông tin hộ kinh doanh </h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- .box-body -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Số hộ kinh doanh</label>
                                            <div class="col-xs-8">
                                                <input name="ma_so_ho_kd" class="form-control"
                                                       value="{{$data->ma_so_ho_kd }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Đăng ký lần đầu</label>
                                            <div class="col-xs-8">
                                                <input name="ngay_dang_ki_1st" class="form-control"
                                                       value="{{$data->ngay_dang_ki_1st}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Tên hộ kinh doanh</label>
                                            <div class="col-xs-8">
                                                <input name="ten_ho_kd" class="form-control"
                                                       value="{{$data->ten_ho_kd }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Số lần thay đổi</label>
                                            <div class="col-xs-8">
                                                <input name="so_lan_thay_doi" class="form-control"
                                                       value="{{$data->so_lan_thay_doi }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Ngày thay đổi</label>
                                            <div class="col-xs-8">
                                                <input name="ngay_thay_doi" class="form-control"
                                                       value="{{$data->ngay_thay_doi }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Website</label>
                                            <div class="col-xs-8">
                                                <input name="website" class="form-control" value="{{$data->website }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Chợ</label>
                                            <div class="col-xs-8">
                                                <select id="list_cho" class="col-xs-6 select2 form-control"
                                                        name="id_cho" disabled>
                                                    <option value="">---Chợ---</option>
                                                    @foreach($list_cho as $item )
                                                        <option @if($data->id_cho == $item->id) selected
                                                                @endif value="{{$item->id}}">{{$item->ten}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Sạp</label>
                                            <div class="col-xs-8 ">
                                                <select class="list_sap col-xs-6 select2 form-control"
                                                        id="list_sap" name="id_sap[]" multiple="multiple" disabled>
                                                    @foreach($list_sap as $item )
                                                        <option {{ in_array($item->id,$list_id_sap_ho_kinh_doanh) ? ' selected ':''}}
                                                                value="{{$item->id}}">{{$item->ten}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Địa điểm kd</label>
                                            <div class="col-xs-8">
                                                @foreach($list_cho as $item )
                                                    @if($data->id_cho == $item->id)
                                                        <input name="" class="form-control" id="dia_chi" readonly
                                                               value="{{isset($item->dia_chi) ? $item->dia_chi : '-'}}">
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Email</label>
                                            <div class="col-xs-8">
                                                <input name="email_ho_kd" class="form-control"
                                                       value="{{$data->email_ho_kd }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Fax</label>
                                            <div class="col-xs-8">
                                                <input name="fax_ho_kd" class="form-control"
                                                       value="{{$data->fax_ho_kd }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số điện thoại</label>
                                            <div class="col-xs-8">
                                                <input name="sdt_ho_kd" class="form-control"
                                                       value="{{$data->sdt_ho_kd }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class="form-control border-none">
                                            <label class="col-xs-4">Ngành Nghề (*)</label>
                                            <div class="col-xs-8">
                                                <select name="id_nganh_kd" class="col-xs-6 select2 form-control" disabled>
                                                    @foreach($list_nganh as $item )
                                                        <option @if($data->id_nganh_kd == $item->id) selected
                                                                @endif value="{{$item->id}}">{{$item->ten_nganh}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Vốn</label>
                                            <div class="col-xs-8">
                                                <input name="von_kd" class="form-control" value="{{$data->von_kd }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số lao động</label>
                                            <div class="col-xs-8 ">
                                                <input name="so_lao_dong" class="form-control" value="{{$data->so_lao_dong }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-solid box-primary">
                            <!-- .box-header -->
                            <div class="box-header">
                                <h3 class="box-title">Thông tin chủ hộ kinh doanh </h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- .box-body -->
                            <div class="box-body">
                                <div class="row" style="display: flex;flex-wrap: wrap;">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Họ đại diện hộ gia đình</label>
                                            <div class="col-xs-8">
                                                <input name="ho_chu_ho_kd" class="form-control"
                                                       value="{{$data->ho_chu_ho_kd }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Tên đại diện hộ gia đình (*)</label>
                                            <div class="col-xs-8 ">
                                                <input name="ten_chu_ho_kd" class="form-control" value="{{$data->ten_chu_ho_kd }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Ngày sinh</label>
                                            <div class="col-xs-8">
                                                <input name="ngay_sinh" class="form-control"
                                                       value="{{$data->ngay_sinh }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: flex;flex-wrap: wrap;">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Dân tộc</label>
                                            <div class="col-xs-8">
                                                <input name="dan_toc" class="form-control" value="{{$data->dan_toc }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Quốc tịch</label>
                                            <div class="col-xs-8">
                                                <input name="quoc_tich" class="form-control"
                                                       value="{{$data->quoc_tich }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Giới tính</label>
                                            <div class="col-xs-8">
                                                <select class="col-xs-6 select2 form-control" name="gioi_tinh"
                                                        value="{{isset($data->gioi_tinh) ? $data->gioi_tinh : "-" }}" disabled>
                                                    <option value="1" <?php if ($data->gioi_tinh == 1) echo "selected"
                                                        ?>>Nam
                                                    </option>
                                                    <option value="2" <?php if ($data->gioi_tinh == 2) echo "selected"
                                                        ?>>Nữ
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: flex;flex-wrap: wrap;">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Loại giấy tờ chứng thực</label>
                                            <div class="col-xs-8">
                                                <select class="col-xs-6 select2 form-control" name="loai_giay_to"
                                                        value="{{isset($data->loai_giay_to) ? $data->loai_giay_to : "-" }}" disabled>
                                                    <option value="1"
                                                            @<?php if ($data->loai_giay_to == 1) echo "selected"
                                                        ?>>Chứng minh nhân dân
                                                    </option>
                                                    <option value="2" <?php if ($data->loai_giay_to == 2) echo "selected"
                                                        ?>>Căn cước công dân
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số giấy chứng thực cá nhân</label>
                                            <div class="col-xs-8">
                                                <input name="ma_so_giay_to" class="form-control"
                                                       value="{{$data->ma_so_giay_to }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Ngày cấp</label>
                                            <div class="col-xs-8">
                                                <input  name="ngay_cap_giay_to" class="form-control"
                                                       value="{{$data->ngay_cap_giay_to }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: flex;flex-wrap: wrap;">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Nơi cấp</label>
                                            <div class="col-xs-8">
                                                <input name="noi_cap" class="form-control" value="{{$data->noi_cap }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số Điện Thoại</label>
                                            <div class="col-xs-8">
                                                <input name="sdt_chu_ho_kd" class="form-control"
                                                       value="{{$data->sdt_chu_ho_kd }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 ">
                                        <div class="row  form-control border-none" style="background-color: transparent">
                                            <label class="col-xs-3" style="padding-left: 30px">Chỗ ở hiện tại</label>
                                            <div class="col-xs-9" style="margin-left: -1.5%;">
                                                <input name="dia_chi_tam_tru" class="form-control" value="{{$data->dia_chi_tam_tru}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="row  form-control border-none" style="background-color: transparent">
                                            <label class="col-xs-3"  style="padding-left: 30px">Nơi đăng ký hộ khẩu thường trú</label>
                                            <div class="col-xs-9" style="margin-left: -1.5%;">
                                                <input name="dia_chi_thuong_tru" class="form-control" value="{{$data->dia_chi_thuong_tru }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-3 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-8">Khám Sức Khỏe</label>
                                            <div class="col-xs-4">
                                                <input type="checkbox" name="kham_suc_khoe"  <?php if ($data->kham_suc_khoe == 1)
                                                    echo "checked";?> value="1" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-8">Giấy xác nhận kiến thức</label>
                                            <div class="col-xs-4">
                                                <input type="checkbox" name="giay_xac_nhan_kien_thuc"  <?php if ($data->giay_xac_nhan_kien_thuc == 1)
                                                    echo "checked";?> value="1" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-8">GCN đủ điều kiện</label>
                                            <div class="col-xs-4">
                                                <input type="checkbox" name="GCN_du_dieu_kien"  <?php if ($data->GCN_du_dieu_kien == 1)
                                                    echo "checked";?> value="1" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-8">Bản cam kết đảm bảo ATTP</label>
                                            <div>
                                                <input type="checkbox" name="ban_cam_ket_dam_bao" value="1" <?php if ($data->ban_cam_ket_dam_bao == 1)
                                                    echo "checked";?> disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-solid box-primary">
                            <!-- .box-header -->
                            <div class="box-header">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <h3 class="box-title">GIẤY CHỨNG NHẬN AN TOÀN THỰC PHẨM </h3>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <p class="radio-button">
                                                    <input type="radio" name="giay_ATTP_Status" value="0" class="radio"
                                                           <?php if ($data->giay_ATTP_Status == 0)
                                                               echo "checked";?>
                                                           id="0" disabled> Đã cấp</p>
                                            </div>
                                            <div class="col-xs-4">
                                                <p class="radio-button">
                                                    <input type="radio" name="giay_ATTP_Status"
                                                           value="1" class="radio" <?php if ($data->giay_ATTP_Status == 1)
                                                        echo "checked";?> id="1" disabled> Đang
                                                    làm</p>
                                            </div>
                                            <div class="col-xs-4">
                                                <p class="radio-button">
                                                    <input type="radio" name="giay_ATTP_Status"
                                                           value="2" class="radio" <?php if ($data->giay_ATTP_Status == 2)
                                                        echo "checked";?> id="2" disabled> Chưa
                                                    làm</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-header -->


                            <!-- .box-body -->
                            <div class="box-body none-table">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Mã số giấy tờ</label>
                                            <div class="col-xs-8">
                                                <input name="ma_so_giay_ATTP" class="input_disable form-control"
                                                       value="{{$data->ma_so_giay_ATTP }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Người cấp</label>
                                            <div class="col-xs-8">
                                                <input name="nguoi_cap" class="input_disable form-control"
                                                       value="{{$data->nguoi_cap }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Thời gian hiệu lực</label>
                                            <div class="col-xs-8">
                                                <input type="date" name="thoi_gian_hieu_luc_ATTP"
                                                       class="input_disable form-control"
                                                       value="{{$data->thoi_gian_hieu_luc_ATTP}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="  form-control border-none"
                                             style="background-color: transparent">
                                            <label class="col-xs-4">Nơi Cấp</label>
                                            <div class="col-xs-8">
                                                <input name="noi_cap_giay_ATTP" class="input_disable form-control"
                                                       value="{{$data->noi_cap_giay_ATTP}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class=" row form-control border-none"
                                             style="background-color: transparent">
                                            <label class="col-xs-4">Ngày Cấp</label>
                                            <div class="col-xs-8">
                                                <input name="ngay_cap_giay_ATTP" class="input_disable form-control" value="{{$data->ngay_cap_giay_ATTP}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class=" row form-control border-none"
                                             style="background-color: transparent">
                                            <label class="col-xs-4 control-label">Đính kèm file</label>
                                            <div class="col-xs-8">
                                                <input type="file" id="file_dinh_kem" class="form-control input_disable"
                                                       name="File_Upload"
                                                       value="chọn file" disabled>
                                                <input type="hidden" id="file_dinh_kem_input" name="File_Upload"
                                                       value="File_Upload" class="input_disable">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
@section('footer')
    <script>
        //getListSap
        $(window).on('load',function () {
            var check = $('.radio-button').find('input[type=radio][name=giay_ATTP_Status]:checked').val();
            if (check == '1') {
                $('.input_disable').attr('disabled', 'disabled');
            }
            else if (check == '2') {
                $('.input_disable').attr('disabled', 'disabled');
            }
            else {
                $('.input_disable').removeAttr("disabled");
            }
        });
        $(document).ready(function () {
            var id_cho = "{{ $data->id_cho }}";
            var hkd = "{{$data->id }}";

            getListSapOfMaket(id_cho, '#list_sap',hkd);
            getListDiaChi(id_cho, '#dia_chi');

            $('#list_cho').change(function () {
                var id = $(this).val();
                getListSap(id, '#list_sap');
                getListDiaChi(id, '#dia_chi');
            });

            $('.radio-button').click(function () {
                $(this).find('input[type=radio]').prop("checked", true);
                var check = $(this).find('input[type=radio][name=giay_ATTP_status]').val();
                if (check == '1') {
                    $('.input_disable').attr('disabled', 'disabled');
                }
                else if (check == '2') {
                    $('.input_disable').attr('disabled', 'disabled');
                }
                else {
                    $('.input_disable').removeAttr("disabled");
                }
            });


            //Upload_file
            $('#btn-upload-file-dinh-kem').on('click', function () {
                var file_data = $('#file_dinh_kem').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                form_data.append('_token', '{{ csrf_token() }}');


                $.ajax({
                    url: "/admin/ajax/upload-file/ho_kinh_doanh", // point to server-side PHP script
                    data: form_data,
                    type: 'POST',
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    success: function (data) {
                        if (data.code === 200) {
                            alert('Upload file thành công ');
                            $('#file_dinh_kem_input').val(data.data.file);
                        }
                    }
                });
            });

        });
        function getListSap(id_cho, class_input) {
            $.get('{{ url('/admin/ajax/list_sap?id_cho=') }}' + id_cho, function (res) {

                if (res.code == 200) {

                    var html3 = '  <option value="">----Sạp---</option>';

                    var data = res.data;
                    for (var i = 0; i < data.length; i++) {
                        html3 += '<option value="' + data[i]['id'] + '">' + data[i]['ma_so_sap'] + ' ' + data[i]['ten'] + '</option>';
                    }
                    $(class_input).html(html3);
                }
            });
        }

        function getListSapOfMaket(id_cho, class_input) {
            $.get('{{ url('/admin/ajax/list_sap?id_cho=') }}' + id_cho+'&&id_ho_kinh_doanh='+ hkd , function (res) {

                if (res.code == 200) {
                    var list_id_selected = [];
                    var current_id_ho_kinh_doanh = '{{ $data->id }}';
                    var html3 = '  <option value="">----Sạp---</option>';

                    var data = res.data;
                    for (var i = 0; i < data.length; i++) {
                        html3 += '<option value="' + data[i]['id'] + '">' + data[i]['ma_so_sap'] + ' ' + data[i]['ten'] + '</option>';

                        if (data[i]['id_ho_kinh_doanh'] == current_id_ho_kinh_doanh) {
                            list_id_selected.push(data[i]['id']);
                        }
                    }
                    $(class_input).html(html3);
                    console.log(list_id_selected);
                    $(class_input).val(list_id_selected).trigger('change');
                }
            });
        }

        function getListDiaChi(id, class_input) {
            $.get('{{ url('/admin/ajax/dia_chi?id=') }}' + id, function (res) {

                if (res.code == 200) {

                    var html3;
                    var data = res.data;
                    var dia_chi = data[0]['dia_chi'];
                    html3 = $("#dia_chi").val(dia_chi);
                    //html3 =  '<input value="' + data[0]['dia_chi'] + '">';

                    $(class_input).html(html3);
                }
            });
        }
        //Get List Cho
    </script>
@endsection
