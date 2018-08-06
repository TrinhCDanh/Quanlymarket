@extends('admin.master')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tạo Hộ Kinh Doanh
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
            <div class="row">
                <div class="col-xs-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="form_add_ho_kd" action="{{route('admin.ho_kinh_doanh.create')}}" method="post">
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
                                            <div class="col-xs-8 ">
                                                <input name="ma_so_ho_kd" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Đăng ký lần đầu (*)</label>
                                            <div class="col-xs-8 ">
                                                <input type="date" name="ngay_dang_ki_1st" class="form-control"
                                                       id="dk-lan-dau">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Tên hộ kinh doanh (*)</label>
                                            <div class="col-xs-8 ">
                                                <input name="ten_ho_kd" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Số lần thay đổi (*)</label>
                                            <div class="col-xs-8 ">
                                                <input name="so_lan_thay_doi" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Ngày thay đổi (*)</label>
                                            <div class="col-xs-8 ">
                                                <input type="date" name="ngay_thay_doi" class="form-control datemask"
                                                       id="ngay-thay-doi">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Website</label>
                                            <div class="col-xs-8 ">
                                                <input name="website" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Chợ (*)</label>
                                            <div class="col-xs-8 ">
                                                <select id="list_cho" name="id_cho" class="form-control select2">
                                                    <option value="">---Chợ---</option>
                                                    @foreach($list as $item)
                                                        <option value="{{$item->id}}">{{$item->ten }}</option>
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
                                                    <option value="">---Sạp---</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Địa điểm kd</label>
                                            <div class="col-xs-8 ">
                                                <input name="" class="form-control" id="dia_chi" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Email</label>
                                            <div class="col-xs-8 ">
                                                <input type="email" name="email_ho_kd" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Fax</label>
                                            <div class="col-xs-8 ">
                                                <input name="fax_ho_kd" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số điện thoại</label>
                                            <div class="col-xs-8 ">
                                                <input name="sdt_ho_kd" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Ngành Nghề (*)</label>
                                            <div class="col-xs-8 ">
                                                <select name="id_nganh_kd" class="select2 form-control">
                                                    <option value="" selected>-Ngành nghề kinh doanh -</option>
                                                    @foreach( $list_nganh as $item)
                                                        <option value="{{$item->id}}">{{$item->ten_nganh}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Vốn (*)</label>
                                            <div class="col-xs-8 ">
                                                <input name="von_kd" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số lao động</label>
                                            <div class="col-xs-8 ">
                                                <input name="so_lao_dong" class="form-control">
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
                                <div class="row">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Họ Đại Diện Hộ Gia Đình (*)</label>
                                            <div class="col-xs-8 ">
                                                <input name="ho_chu_ho_kd" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Tên đại diện hộ gia đình (*)</label>
                                            <div class="col-xs-8 ">
                                                <input name="ten_chu_ho_kd" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Ngày Sinh</label>
                                            <div class="col-xs-8 ">
                                                <input type="date" name="ngay_sinh" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Dân tộc</label>
                                            <div class="col-xs-8 ">
                                                <input name="dan_toc" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Quốc Tịch</label>
                                            <div class="col-xs-8 ">
                                                <input name="quoc_tich" class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Giới tính</label>
                                            <div class="col-xs-8 ">
                                                <select name="gioi_tinh" class="form-control select2">
                                                    <option value="1">Nam</option>
                                                    <option value="2">Nữ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Loại giấy tờ chứng thực (*)</label>
                                            <div class="col-xs-8 ">
                                                <select name="loai_giay_to" class="form-control select2">
                                                    <option selected></option>
                                                    <option value="1">Chứng minh nhân dân</option>
                                                    <option value="2">Căn cước công dân</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số giấy tờ chứng thực (*)</label>
                                            <div class="col-xs-8 ">
                                                <input name="ma_so_giay_to" class="form-control ">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Ngày cấp</label>
                                            <div class="col-xs-8 ">
                                                <input type="date" name="ngay_cap_giay_to" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-4 ">
                                        <div class=" form-control border-none">
                                            <label class="col-xs-4">Nơi Cấp</label>
                                            <div class="col-xs-8 ">
                                                <input name="noi_cap" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Số Điện Thoại</label>
                                            <div class="col-xs-8 ">
                                                <input name="sdt_chu_ho_kd" class="form-control">
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
                                                <input name="dia_chi_tam_tru" class="form-control">
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
                                                <input name="dia_chi_thuong_tru" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none" style="background-color: transparent">
                                            <div class="col-xs-12">
                                                <label for="khamsuckhoe">
                                                    <span class="checkbox-button">Khám Sức Khỏe</span>
                                                    <input type="checkbox" name="kham_suc_khoe" value="1"
                                                           class="checkbox" id="khamsuckhoe" style="display: inline-block;">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none">
                                            {{--<div for="giayxacnhan">--}}
                                                {{--<div class="col-xs-8">Giấy xác nhận kiến thức</div>--}}
                                                <div class="col-xs-12">
                                                    <label for="giayxacnhan">
                                                    <span class="checkbox-button">Giấy xác nhận kiến thức</span>
                                                    <input type="checkbox" name="giay_xac_nhan_kien_thuc" value="1"
                                                           class="checkbox" id="giayxacnhan" style="display: inline-block">
                                                    </label>
                                                </div>
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none">
                                            <div class="col-xs-12">
                                                <label for="gcndudk">
                                                    <span class="checkbox-button">GCN đủ điều kiện</span>
                                                    <input type="checkbox" name="GCN_du_dieu_kien" value="1"
                                                           class="checkbox" id="gcndudk" style="display: inline-block">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="row  form-control border-none">
                                            <div class="col-xs-12">
                                                <label for="bancamket">
                                                    <span class="checkbox-button">Bản cam kết đảm bảo ATTP</span>
                                                    <input type="checkbox" name="ban_cam_ket_dam_bao" value="1"
                                                           class="checkbox" id="bancamket" style="display: inline-block">
                                                </label>
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
                                                <span class="radio-button">
                                                    <input type="radio" name="giay_ATTP_Status" value="0" class="radio"
                                                           id="0"> Đã cấp</span>
                                            </div>
                                            <div class="col-xs-4">
                                                <span class="radio-button">
                                                    <input type="radio" name="giay_ATTP_Status"
                                                           value="1" class="radio" id="2"> Đang
                                                    làm</span>
                                            </div>
                                            <div class="col-xs-4">
                                                <span class="radio-button">
                                                    <input type="radio" name="giay_ATTP_Status"
                                                           value="2" class="radio" id="3"> Chưa
                                                    làm</span>
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
                                                <input name="ma_so_giay_ATTP" class="input_disable form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Người cấp</label>
                                            <div class="col-xs-8">
                                                <input name="nguoi_cap" class="input_disable form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row  form-control border-none">
                                            <label class="col-xs-4">Thời gian hiệu lực</label>
                                            <div class="col-xs-8">
                                                <input type="date" name="thoi_gian_hieu_luc_ATTP"
                                                       class="input_disable form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class=" form-control border-none"
                                             style="background-color: transparent">
                                            <label class="col-xs-4">Nơi Cấp</label>
                                            <div class="col-xs-8">
                                                <input name="noi_cap_giay_ATTP" class="input_disable form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class=" row form-control border-none"
                                             style="background-color: transparent">
                                            <label class="col-xs-4">Ngày Cấp</label>
                                            <div class="col-xs-8">
                                                <input name="ngay_cap_giay_ATTP" class="input_disable form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class=" row form-control border-none"
                                             style="background-color: transparent">
                                            <label class="col-xs-4 control-label">Đính kèm file</label>
                                            <div class="col-xs-8">
                                                <input type="file" id="file_dinh_kem" class="form-control input_disable"
                                                       name="file"
                                                       value="chọn file">
                                                <input type="hidden" id="file_dinh_kem_input" name="File_Upload"
                                                       value="">
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
                        <!-- Trigger the modal with a button -->

                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('footer')
    <script>
        //getListSap
        $(document).ready(function () {
            function getListSap(id_cho, class_input) {
                $.get('{{ url('/admin/ajax/list_sap?id_cho=') }}' + id_cho, function (res) {

                    if (res.code == 200) {

                        var html3 = '  <option value="">----Sạp---</option>';

                        var data = res.data;
                        for (var i = 0; i < data.length; i++) {
                            html3 += '<option value="' + data[i]['id'] + '">' + data[i]['ma_so_sap'] + ' - ' + data[i]['ten'] + '</option>';
                        }
                        $(class_input).html(html3);
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
                        //html3 =  '<input value="' + data[0]['dia_chi'] + '">';

                        $(class_input).html(html3);
                    }
                });
            }

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



            $('#form_add_ho_kd').submit(function (e) {
                e.preventDefault();
                var exportForm = $('form#form_add_ho_kd');
                $.ajax({
                    url: "{{ route('admin.ho_kinh_doanh.create') }}",
                    type: 'POST',
                    data: exportForm.serialize(),
                    success: function (res) {
                        $('select').parent().find('p').remove();
                        $('input').parent().find('p').remove();
                        console.log(res.code);
                        var datechange = $("#ngay-thay-doi").val();
                        var datefirst = $("#dk-lan-dau").val();
                        if (datechange < datefirst) {
                            var error = "Ngày thay đổi phải lớn hơn hoặc bằng ngày đăng ký";
                            $('input[name="ngay_thay_doi"]').parent().append('<p style="color: red;">' + error + '</p>');
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
                            alert('Thêm hộ kinh doanh thành công');
                            window.location.href = '{{ route('admin.ho_kinh_doanh.list') }}'
                        }
                    }
                });
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


    </script>
@endsection
<style>
    #output {
        padding: 20px;
        background: #dadada;
    }

    .radio {
        margin-right: 5px !important;
        display: inline-block !important;
    }

    .radio-button {
        display: inline-block;
        /*padding-right: 13%;*/
    }
</style>
