@extends('admin.master')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh Sách Hộ Kinh Doanh
                <small>
                    <a href="{{route("admin.ho_kinh_doanh.add")}}">
                        <button class="btn btn-primary">Tạo mới</button>
                    </a>
                </small>

                <small>
                    <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#importModals">Import
                    </button>
                    <div class="row">
                        <!--  <div class="col-sm-12">
                         <button type="button" class="btn btn-info" data-toggle="modal"
                                 data-target="#importModals">Import
                         </button>
                     </div> -->
                        <!-- The Modal -->
                        <div class="modal" id="importModals">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Import</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;
                                        </button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h3><b> Bấm vào</b>
                                                    <a href="{{ url('/excel/import_ho_kinh_doanh.xlsx') }}"
                                                       class="text-red">đây</a>
                                                    <b> để tải xuống bản mẫu Excel</b></h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <form id="importFormSubmit" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <input id="file-import" class="form-control" type="file"
                                                                       name="file_import"/>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-success" type="submit">Import
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-9">
                                                                <div class="list-errors"
                                                                     style="color: red; text-align: center;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            Đóng
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content table-border">
            <form action="{{route("admin.ho_kinh_doanh.list")}}" method="get">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-solid box-primary">
                            <!-- .box-header -->
                            <div class="box-header">
                                <h3 class="box-title">Thông tin hộ kinh doanh </h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- .box-body -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <input name="value" class="form-control"
                                                       value="{{ isset($_GET['value']) ? $_GET['value'] : ''}}"
                                                       placeholder="Từ Khóa">
                                            </div>
                                            <div class="col-xs-4">
                                                <select class=" form-control" name="tu_khoa">
                                                    <option value="" selected>Chọn</option>
                                                    <option {{ isset($_GET['tu_khoa'])&& $_GET['tu_khoa'] == 1 ? 'selected' : ''}} value="1">
                                                        Số Hộ KD
                                                    </option>
                                                    <option {{ isset($_GET['tu_khoa'])&& $_GET['tu_khoa'] == 2 ? 'selected' : ''}} value="2">
                                                        Tên Hộ KD
                                                    </option>
                                                    {{--<option>Số GCN ĐKKD</option>--}}
                                                    <option {{ isset($_GET['tu_khoa'])&& $_GET['tu_khoa'] == 3 ? 'selected' : ''}} value="3">
                                                        Điện Thoại
                                                    </option>
                                                    <option {{ isset($_GET['tu_khoa'])&& $_GET['tu_khoa'] == 4 ? 'selected' : ''}} value="4">
                                                        Email
                                                    </option>
                                                    <option {{ isset($_GET['tu_khoa'])&& $_GET['tu_khoa'] == 5 ? 'selected' : ''}} value="5">
                                                        Mã số giấy tờ
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="row">
                                            <div class="col-xs-8 text-right custom-select-excel">
                                                <select class="form-control" id="export_type" name="export">
                                                    <option value="excel">Excel</option>
                                                    <option value="pdf">PDF</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 text-right">
                                                <a class="form-control btn btn-primary" id="export" style="width: 72px "
                                                   download="">Export</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-8">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <select class=" form-control" name="id_cho">
                                                    <option value="" selected>-- Chọn Chợ --</option>
                                                    @foreach($data_cho as $item)
                                                        <option value="{{ $item->id }}" {{ isset($_GET['id_cho'])&& $_GET['id_cho'] == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                                <select class=" form-control" name="id_nganh_kd">
                                                    <option value="" selected>-- Chọn Ngành Kinh Doanh --</option>
                                                    @foreach($list_nganh as $item)
                                                        <option {{ isset($_GET['id_nganh_kd'])&& $_GET['id_nganh_kd'] == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{ $item->ten_nganh }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <button class="btn btn-primary" type="submit" style="width: 80px">Lọc
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- excel export -->
                                    <div class="col-xs-4">
                                        <div class="row">
                                            <div class="col-xs-4 text-right">
                                                <select class="form-control" name="orderBy">
                                                    <option value="" selected>-- Chọn --</option>
                                                    <option value="1" {{ isset($_GET['orderBy'])&& $_GET['orderBy'] == 1 ? 'selected' : ''}}>
                                                        Tên hộ kinh doanh
                                                    </option>
                                                    <option value="2" {{ isset($_GET['orderBy'])&& $_GET['orderBy'] == 2 ? 'selected' : ''}}>
                                                        Ngày cấp giấy tờ
                                                    </option>
                                                    <option value="3" {{ isset($_GET['orderBy'])&& $_GET['orderBy'] == 3 ? 'selected' : ''}}>
                                                        Tên chủ hộ đại diện
                                                    </option>
                                                    <option value="4" {{ isset($_GET['orderBy'])&& $_GET['orderBy'] == 4 ? 'selected' : ''}}>
                                                        Ngày Tạo
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 text-right">
                                                <select class="form-control" name="orderBySTT">
                                                    option value="" selected>-- Chọn --</option>
                                                    <option value="1" {{ isset($_GET['orderBySTT'])&& $_GET['orderBySTT'] == 1 ? 'selected' : ''}}>
                                                        Giảm dần
                                                    </option>
                                                    <option value="2" {{ isset($_GET['orderBySTT'])&& $_GET['orderBySTT'] == 2 ? 'selected' : ''}}>
                                                        Tăng dần
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 text-right">
                                                <button class="btn btn-primary" type="submit" style="width: 73px">Sắp
                                                    xếp
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.excel export -->
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>

                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Danh sách hộ kinh doanh </h3>
                                <small>Hiển thị {{ $countPerPage.' / '.$total }} tổng số dữ liệu</small>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body custom-table">
                                <div class="table-responsive">
                                    <table class="table table-hover" style="min-width: 1500px;">
                                        <thead class="">
                                        <tr>
                                            <th style=" width: 150px">Chức Năng</th>
                                            <th>STT</th>
                                            <th>Số Hộ KD</th>
                                            <th style="width: 87px;">Tên hộ kinh doanh
                                            <th>Chợ</th>
                                            <th>Sạp</th>
                                            <th>Địa điểm KD</th>
                                            <th>Ngành nghề</th>
                                            <th>Số điện thoại</th>
                                            <th>Fax</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th colspan="2">Họ và Tên người đại diện</th>
                                            <th>Địa chỉ thường trú</th>
                                            <th>Loại giấy tờ CTCN</th>
                                            <th>Số giấy tờ</th>
                                            <th>Ngày cấp</th>
                                            <th>Nơi cấp</th>
                                        </tr>
                                        <!-- <tr>
                                            <th>Số GCN</th>
                                            <th>Thời gian
                                                hiệu lực</th>
                                        </tr> -->
                                        </thead>
                                        <tbody>
                                        @foreach($list as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{route("admin.ho_kinh_doanh.show",$item->id)}}"
                                                       class="btn btn-success btn-xs">Chi tiết</a>
                                                    <a onclick="return confirm('Bạn có muốn xóa không?') ;"
                                                       href="{{ route('admin.ho_kinh_doanh.delete', $item->id) }}"
                                                       class="btn btn-danger btn-xs">Xóa</a>
                                                    <a href="{{ route('admin.ho_kinh_doanh.edit', $item->id) }}"
                                                       class="btn btn-primary btn-xs">Sửa</a>
                                                    <a href="{{route('admin.mat_hang_kinh_doanh.list',$item->id)}}"
                                                       class="btn btn-success btn-xs">Mặt hàng KD</a>
                                                </td>
                                                <td>{{$start_order++}}</td>
                                                <td>{{isset($item->ma_so_ho_kd)? $item->ma_so_ho_kd : "-"}}</td>
                                                <td>{{isset($item->ten_ho_kd)? $item->ten_ho_kd : "-"}}</td>
                                                <td>{{isset($item->id_cho->ten) ? $item->id_cho->ten : "-"}}</td>
                                                <td>{{isset($item->ma_sap) ? $item->ma_sap : "-"}}</td>
                                                <td>{{isset($item->id_cho->dia_chi) ? $item->id_cho->dia_chi : "-"}}</td>
                                                <td>{{isset($item->id_nganh_kd)? $item->id_nganh_kd : "-"}}</td>
                                                <td>{{isset($item->sdt_ho_kd)? $item->sdt_ho_kd : "-"}}</td>
                                                <td>{{isset($item->fax_ho_kd)? $item->fax_ho_kd : "-"}}</td>
                                                <td>{{isset($item->email_ho_kd)? $item->email_ho_kd : "-"}}</td>
                                                <td>{{isset($item->website)? $item->website:"-"}}</td>
                                                @if(isset($item->ho_chu_ho_kd) || ($item->ten_chu_ho_kd) )
                                                    <td colspan="2">{{$item->ho_chu_ho_kd}} {{$item->ten_chu_ho_kd}}</td>
                                                @else
                                                    <td colspan="2">-</td>
                                                @endif
                                                <td>{{isset($item->dia_chi_thuong_tru) ? $item->dia_chi_thuong_tru : "-"}}</td>
                                                @if($item->loai_giay_to == 1)
                                                    <td>Chứng Minh Nhân Dân</td>
                                                @elseif($item->loai_giay_to == 2)
                                                    <td>Căn Cước Công Dân</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{isset($item->ma_so_giay_to) ? $item->ma_so_giay_to : "-"}}</td>
                                                <td>{{isset($item->ngay_cap_giay_to) ?  \Carbon\Carbon::createFromFormat('Y-m-d',$item->ngay_cap_giay_to)->format('d-m-Y') : "-"}}</td>
                                                <td>{{isset($item->noi_cap) ? $item->noi_cap : "-"}}</td>
                                            </tr>
                                        @endforeach

                                        @if(Session::has('message'))
                                            <div class="alert alert-success">
                                                <b style="text-align: center">{!! Session::get('message') !!}</b>
                                            </div>
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th style=" width: 150px">Chức Năng</th>
                                            <th>STT</th>
                                            <th>Số Hộ KD</th>
                                            <th style="width: 87px;">Tên hộ kinh doanh</th>
                                            <th>Chợ</th>
                                            <th>Sạp</th>
                                            <th>Địa điểm KD</th>
                                            <th>Ngành nghề</th>
                                            <th>Số điện thoại</th>
                                            <th>Fax</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th colspan="2">Họ và Tên người đại diện</th>
                                            <th>Địa chỉ thường trú</th>
                                            <th>Loại giấy tờ CTCN</th>
                                            <th>Số giấy tờ</th>
                                            <th>Ngày cấp</th>
                                            <th>Nơi cấp</th>
                                        </tr>
                                        <!-- <tr>
                                            <th>Số GCN</th>
                                            <th>Thời gian
                                                hiệu lực</th>
                                        </tr> -->
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2 text-left record-show">
                                        <select id="mySelect" class="form-control select" name="paginate"
                                                onchange="this.form.submit()">
                                            <option value="10" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 10 ? 'selected' : '' }}>
                                                10 kết quả
                                            </option>
                                            <option value="20" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 20 ? 'selected' : '' }}>
                                                20 kết quả
                                            </option>
                                            <option value="30" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 30 ? 'selected' : '' }}>
                                                30 kết quả
                                            </option>
                                        </select>
                                        <p id="demo"></p>
                                    </div>
                                    <div class="col-xs-10 paginate text-right">
                                        {!! $paginate !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
        @endsection
        @section('footer')
            <script>

                $('div.alert-success').delay(2000).slideUp();

                function tempAlert(msg, duration) {
                    var el = document.createElement("div");
                    el.setAttribute("style", "position:absolute;top:40%;left:20%;background-color:white;");
                    el.innerHTML = msg;
                    setTimeout(function () {
                        el.parentNode.removeChild(el);
                    }, duration);
                    document.body.appendChild(el);
                }

                function numberpage() {
                    var x = document.getElementById("mySelect").value;
                    document.getElementById("demo").innerHTML = x;
                }

                $("#export").click(function (e) {
                    var cho = "{{(isset($_GET['id_cho']) ? $_GET['id_cho'] : "")}}";
                    var nganh_kd = "{{(isset($_GET['id_nganh_kd']) ? $_GET['id_nganh_kd'] : "")}}";
                    var value =  "{{(isset($_GET['value']) ? $_GET['value'] : "")}}";
                    var tu_khoa =  "{{(isset($_GET['tu_khoa']) ? $_GET['tu_khoa'] : "")}}";
                    var orderBy = "{{(isset($_GET['orderBy']) ? $_GET['orderBy'] : "")}}"
                    var orderBySTT = "{{(isset($_GET['orderBySTT']) ? $_GET['orderBySTT'] : "")}}"
                    var type = $('#export_type').val();
                    if (type === 'excel') {
                        location.href = '{{route('admin.ho_kinh_doanh.export')}}?id_cho='+cho +'&id_nganh_kd='+nganh_kd+'&value='+value+'&tu_khoa='+tu_khoa+'&orderBy='+orderBy+'&orderBySTT='+orderBySTT;
                    }
                    else if(type === 'pdf'){
                        location.href = '{{route('admin.ho_kinh_doanh.exportpdf')}}?id_cho='+cho +'&id_nganh_kd='+nganh_kd+'&value='+value+'&tu_khoa='+tu_khoa+'&orderBy='+orderBy+'&orderBySTT='+orderBySTT;
                    }
                });


                $(document).ready(function () {
                    $.urlParam = function (name) {
                        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                        if (results == null) {
                            return null;
                        }

                        else {
                            return decodeURI(results[1]) || 0;
                        }
                    }
                    $("form#importFormSubmit").submit(function (e) {
                        if (document.getElementById("file-import").files.length == 0) {
                            $('#importModals .modal-body .list-errors').html('Vui lòng chọn File');
                        } else {
                            $('#importModals .modal-body .list-errors').html('Đang tải...');
                        }
                        e.preventDefault();
                        // $('#importModals .modal-body .list-errors').html('Đang tải....');
                        var formData = new FormData(this);

                        $.ajax({
                            url: '/admin/ajax/ho-kinh-doanh/import',
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                $('#importModals .modal-body .list-errors').html('');
                                if (data.code == 200) {
                                    $('#importModals').modal('hide');
                                    alert('Import thành công');
                                }
                                else {
                                    var errors = data.data;
                                    for (var i = 0; i < errors.length; i++) {
                                        console.log(errors[i]);
                                        $('#importModals .modal-body .list-errors').append('<p>' + errors[i] + '</p>'
                                        )
                                        ;
                                    }
                                }

                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    });
                });
            </script>
            @endsection