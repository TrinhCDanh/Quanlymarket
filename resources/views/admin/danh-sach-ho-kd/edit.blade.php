@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa Hộ Kinh Doanh
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif
        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12">
                    <form id="form_update_ho_kd" action="{{ route('admin.ho_kinh_doanh.update',['id'=>$data->id]) }}"
                          method="post">
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
                                            <label class="col-xs-4">Số GCN ĐKKD (*)</label>
                                            <div class="col-xs-8">
                                                <input name="ma_so_ho_kd" class="form-control"
                                                       value="{{$data->ma_so_ho_kd }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Đăng ký lần đầu (*)</label>
                                            <div class="col-xs-8">
                                                <input type="date" name="ngay_dang_ki_1st" class="form-control"
                                                       value="{{$data->ngay_dang_ki_1st}}" id="dk-lan-dau">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Tên hộ kinh doanh (*)</label>
                                            <div class="col-xs-8">
                                                <input name="ten_ho_kd" class="form-control"
                                                       value="{{$data->ten_ho_kd }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Số lần thay đổi (*)</label>
                                            <div class="col-xs-8">
                                                <input name="so_lan_thay_doi" class="form-control"
                                                       value="{{$data->so_lan_thay_doi }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Ngày thay đổi (*)</label>
                                            <div class="col-xs-8">
                                                <input type="date" name="ngay_thay_doi" class="form-control"
                                                       value="{{$data->ngay_thay_doi }}" id="ngay-thay-doi">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Website</label>
                                            <div class="col-xs-8">
                                                <input name="website" class="form-control" value="{{$data->website }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Chợ (*)</label>
                                            <div class="col-xs-8">
                                                <select id="list_cho" class="col-xs-6 select2 form-control"
                                                        name="id_cho">
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
                                            <label class="col-xs-4">Sạp (*)</label>
                                            <div class="col-xs-8 ">
                                                <select class="list_sap col-xs-6 select2 form-control"
                                                        id="list_sap" name="sap[]" multiple="multiple">
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
                                            <label class="col-xs-4">Địa điểm kd </label>
                                            <div class="col-xs-8">
                                                @foreach($list_cho as $item )
                                                    @if($data->id_cho == $item->id)
                                                        <input name="" class="form-control" id="dia_chi" readonly
                                                               value="{{isset($item->dia_chi) ? $item->dia_chi : '-'}}"
                                                        >
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
                                                <input type="email" name="email_ho_kd" class="form-control"
                                                       value="{{$data->email_ho_kd }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Fax</label>
                                            <div class="col-xs-8">
                                                <input name="fax_ho_kd" class="form-control"
                                                       value="{{$data->fax_ho_kd }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số điện thoại</label>
                                            <div class="col-xs-8">
                                                <input name="sdt_ho_kd" class="form-control"
                                                       value="{{$data->sdt_ho_kd }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class="form-control border-none">
                                            <label class="col-xs-4">Ngành Nghề (*)</label>
                                            <div class="col-xs-8">
                                                <select name="id_nganh_kd" class="col-xs-6 select2 form-control">
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
                                            <label class="col-xs-4">Vốn (*)</label>
                                            <div class="col-xs-8">
                                                <input name="von_kd" class="form-control" value="{{$data->von_kd }}"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số lao động</label>
                                            <div class="col-xs-8 ">
                                                <input name="so_lao_dong" class="form-control" value="{{$data->so_lao_dong }}">
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
                                            <label class="col-xs-4">Họ đại diện hộ gia đình (*)</label>
                                            <div class="col-xs-8">
                                                <input name="ho_chu_ho_kd" class="form-control"
                                                       value="{{$data->ho_chu_ho_kd }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Tên đại diện hộ gia đình (*)</label>
                                            <div class="col-xs-8 ">
                                                <input name="ten_chu_ho_kd" class="form-control" value="{{$data->ten_chu_ho_kd }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Ngày sinh</label>
                                            <div class="col-xs-8">
                                                <input type="date" name="ngay_sinh" class="form-control"
                                                       value="{{$data->ngay_sinh }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: flex;flex-wrap: wrap;">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Dân tộc</label>
                                            <div class="col-xs-8">
                                                <input name="dan_toc" class="form-control" value="{{$data->dan_toc }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Quốc tịch</label>
                                            <div class="col-xs-8">
                                                <input name="quoc_tich" class="form-control"
                                                       value="{{$data->quoc_tich }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Giới tính</label>
                                            <div class="col-xs-8">
                                                <select class="col-xs-6 select2 form-control" name="gioi_tinh"
                                                        value="{{isset($data->gioi_tinh) ? $data->gioi_tinh : "-" }}"
                                                >
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
                                            <label class="col-xs-4">Loại giấy tờ chứng thực (*)</label>
                                            <div class="col-xs-8">
                                                <select class="col-xs-6 select2 form-control" name="loai_giay_to"
                                                        value="{{isset($data->loai_giay_to) ? $data->loai_giay_to : "-" }}"
                                                >
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
                                            <label class="col-xs-4">Số giấy chứng thực cá nhân (*)</label>
                                            <div class="col-xs-8">
                                                <input name="ma_so_giay_to" class="form-control"
                                                       value="{{$data->ma_so_giay_to }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Ngày cấp</label>
                                            <div class="col-xs-8">
                                                <input type="date" name="ngay_cap_giay_to" class="form-control"
                                                       value="{{$data->ngay_cap_giay_to }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: flex;flex-wrap: wrap;">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Nơi cấp</label>
                                            <div class="col-xs-8">
                                                <input name="noi_cap" class="form-control" value="{{$data->noi_cap }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số Điện Thoại</label>
                                            <div class="col-xs-8">
                                                <input name="sdt_chu_ho_kd" class="form-control"
                                                       value="{{$data->sdt_chu_ho_kd }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 ">
                                        <div class="row  form-control border-none"
                                             style="background-color: transparent">
                                            <label class="col-xs-3" style="padding-left: 30px">Chỗ ở hiện tại</label>
                                            <div class="col-xs-9" style="margin-left: -1.5%;">
                                                <input name="dia_chi_tam_tru" class="form-control"
                                                       value="{{$data->dia_chi_tam_tru}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="row  form-control border-none"
                                             style="background-color: transparent">
                                            <label class="col-xs-3" style="padding-left: 30px">Nơi đăng ký hộ khẩu
                                                thường trú</label>
                                            <div class="col-xs-9" style="margin-left: -1.5%;">
                                                <input name="dia_chi_thuong_tru" class="form-control"
                                                       value="{{$data->dia_chi_thuong_tru }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-3 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-8">Khám Sức Khỏe</label>
                                            <div class="col-xs-4">
                                                <input type="checkbox" name="kham_suc_khoe"
                                                       value="1" <?php if ($data->kham_suc_khoe == 1)
                                                    echo "checked";?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-8">Giấy xác nhận kiến thức</label>
                                            <div class="col-xs-4">
                                                <input type="checkbox" name="giay_xac_nhan_kien_thuc"
                                                       <?php if ($data->giay_xac_nhan_kien_thuc == 1)
                                                           echo "checked";?> value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-8">GCN đủ điều kiện</label>
                                            <div class="col-xs-4">
                                                <input type="checkbox" name="GCN_du_dieu_kien"
                                                       <?php if ($data->GCN_du_dieu_kien == 1)
                                                           echo "checked";?> value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-8">Bản cam kết đảm bảo ATTP</label>
                                            <div>
                                                <input type="checkbox" name="ban_cam_ket_dam_bao"
                                                       value="1" <?php if ($data->ban_cam_ket_dam_bao == 1)
                                                    echo "checked";?>>
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
                                                           id="0"> Đã cấp</p>
                                            </div>
                                            <div class="col-xs-4">
                                                <p class="radio-button">
                                                    <input type="radio" name="giay_ATTP_Status"
                                                           value="1" class="radio" <?php if ($data->giay_ATTP_Status == 1)
                                                        echo "checked";?> id="1"> Đang
                                                    làm</p>
                                            </div>
                                            <div class="col-xs-4">
                                                <p class="radio-button">
                                                    <input type="radio" name="giay_ATTP_Status"
                                                           value="2" class="radio" <?php if ($data->giay_ATTP_Status == 2)
                                                        echo "checked";?> id="2"> Chưa
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
                                                       value="{{$data->ma_so_giay_ATTP }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Người cấp</label>
                                            <div class="col-xs-8">
                                                <input name="nguoi_cap" class="input_disable form-control"
                                                       value="{{$data->nguoi_cap }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Thời gian hiệu lực</label>
                                            <div class="col-xs-8">
                                                <input type="date" name="thoi_gian_hieu_luc_ATTP"
                                                       class="input_disable form-control"
                                                       value="{{$data->thoi_gian_hieu_luc_ATTP}}">
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
                                                       value="{{$data->noi_cap_giay_ATTP}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class=" row form-control border-none"
                                             style="background-color: transparent">
                                            <label class="col-xs-4">Ngày Cấp</label>
                                            <div class="col-xs-8">
                                                <input type="date" name="ngay_cap_giay_ATTP" class="input_disable form-control" value="{{$data->ngay_cap_giay_ATTP}}">
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
                                                       value="chọn file">
                                                <input type="hidden" id="file_dinh_kem_input" name="File_Upload"
                                                       value="File_Upload" class="input_disable">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary" id="btn-upload-file-dinh-kem">Lưu</button>
                            <a onclick="return confirm('Quay lại danh sách hộ kinh doanh?') ;"
                               href="{{ route('admin.ho_kinh_doanh.list') }}"
                               class="btn btn-danger">Hủy</a>
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
            var id_HKD = "{{$data->id}}";

            getListSapOfMaket(id_cho, '#list_sap',id_HKD);
            getListDiaChi(id_cho, '#dia_chi');

            $('#list_cho').change(function () {
                var id = $(this).val();
                getListSap(id, '#list_sap');
                getListDiaChi(id, '#dia_chi');
            });

            $('.radio-button').click(function () {
                $(this).find('input[type=radio]').prop("checked", true);
                var check = $(this).find('input[type=radio][name=giay_ATTP_Status]').val();
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
                    url: "/admin/ajax/upload-file/ho_kinh_doanh",
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    cache: false,
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

        function getListSapOfMaket(id_cho, class_input,id_HKD) {
            $.get('{{ url('/admin/ajax/list_sap?id_cho=') }}' + id_cho + '&&id_ho_kinh_doanh='+ id_HKD, function (res)
            {
                console.log(res);
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
                    $(class_input).val(list_id_selected).trigger('change');
                }
            });
        }

        function getListDiaChi(id, class_input) {
            $.get('{{ url('/admin/ajax/dia_chi?id=') }}' + id, function (res) {

                if (res.code == 200) {

                    var html3;
                    var data = res.data;
                    for (var i = 0; i < data.length; i++) {
                        html3 = $("#dia_chi").val(data[i]['dia_chi']);
                    }
                    $(class_input).html(html3);
                }
            });
        }

        $('#form_update_ho_kd').submit(function (e) {
            e.preventDefault();
            var exportForm = $('form#form_update_ho_kd');
            $.ajax({
                url: "{{ route('admin.ho_kinh_doanh.update',$data->id) }}",
                type: 'POST',
                data: exportForm.serialize(),
                success: function (res) {
                    //$('input').parent().find('p').remove();
                    $('select').parent().find('p').remove();
                    console.log(res.code);
                    var datechange = $("#ngay-thay-doi").val();
                    var datefirst = $("#dk-lan-dau").val();
                    if (datechange < datefirst) {
                        var error = "Ngày thay đổi phải lớn hơn hoặc bằng ngày đăng ký";
                        var x = $('input[name="ngay_thay_doi"]').parent().append('<p style="color: red;">' + error + '</p>');
                        console.log('aaaa');
                        return false;
                    }
                    //console.log(datechange);
                    console.log(datefirst);
                    if (res.code == 202) {
                        var errors = res.data;
                        var errors_array = JSON.parse(JSON.stringify(errors));
                        console.log(errors_array);
                        for (var i = 0; i < errors_array.length; i++) {
                            if (errors_array[i].key === 'sap') {
                                $('.error-sap').html(errors_array[i].mess);
                            }
                            else {
                                $('input[name="' + errors_array[i].key + '"]').parent().append('<p style="color: red;">' + errors_array[i].mess + '</p>');
                                $('select[name="' + errors_array[i].key + '"]').parent().append('<p style="color: red;">' + errors_array[i].mess + '</p>');
                            }
                            if (errors_array[i].key === 'sap') {
                                $('#list_sap').parent().append('<p style="color: red;">' + errors_array[i].mess + '</p>');

                            }
                        }
                    }
                    if (res.code == 200) {
                        console.log(res);
                        alert('Sửa hộ kinh doanh thành công');
                        window.location.href = '{{ route('admin.ho_kinh_doanh.list') }}'
                    }
                }
            });
        });

        //Get List Cho
    </script>
@endsection
