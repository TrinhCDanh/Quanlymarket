@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách cơ sở cung cấp
                <small>
                    <a href="{{ route('admin.co_so_cung_cap.create') }}" class="btn btn-primary">Thêm mới</a>
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
                                            <h3><b > Bấm vào</b>
                                            <a href="{{ url('/excel/import_co_so_cung_cap.xlsx') }}" class="text-red">đây</a>
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
                                                            <button class="btn btn-success" type="submit">Import</button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <div class="list-errors"
                                                            style="color: red;">
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
                <li class="active">Danh sách cơ sở cung cấp</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content table-border">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box box-solid box-primary">
                            <!-- .box-header -->
                            <div class="box-header">
                                <h3 class="box-title">Chức năng </h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- .box-body -->
                            <form action="{{route('admin.co_so_cung_cap.list')}}" method="GET">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <input name="searchValue" class="form-control" placeholder="Từ Khóa" value="{{ isset($_GET['searchValue']) ? $_GET['searchValue'] : '' }}">
                                                </div>
                                                <div class="col-xs-4">
                                                    <select name="searchOption" class="form-control">
                                                        <option value="0">-- Chọn --</option>
                                                        <option value="1" <?php if(isset($_GET['searchOption']) && $_GET['searchOption'] == 1) echo 'selected'; ?>>Tất cả</option>
                                                        <option value="2" <?php if(isset($_GET['searchOption']) && $_GET['searchOption'] == 2) echo 'selected'; ?>>Tên</option>
                                                        <option value="3" <?php if(isset($_GET['searchOption']) && $_GET['searchOption'] == 3) echo 'selected'; ?>>Số điện thoại</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-4 text-center">
                                                    <button class="btn btn-primary">Tìm Kiếm</button>
                                                    <a href="{{ route('admin.co_so_cung_cap.list') }}" class="btn btn-danger">Làm mới</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    @if(Session::has('message'))
                    <div class="alert alert-success">
                        <b style="text-align: center">{!! Session::get('message') !!}</b>
                    </div>
                    @endif
                    <div class="box">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Quản lý cơ sở cung cấp </h3>
                                <small>Hiển thị {{ $countPerPage.' / '.$count }} tổng số dữ liệu</small>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body custom-table">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="">
                                        <tr>
                                            <!--<th rowspan="2">#</th> -->
                                            <th rowspan="2" width="150px">Chức năng</th>
                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Tên cơ sở</th>
                                            <th rowspan="2">Số điện thoại</th>
                                            <th rowspan="2">Địa chỉ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!$data->isEmpty())
                                            @foreach($data as $item)
                                        <tr style="text-align: center;">
                                            <!--<td><input type="checkbox"></td>-->
                                            <td>
                                                <a href="{{ route('admin.co_so_cung_cap.show', $item->id) }}" class="btn btn-xs btn-info">Xem </a>
                                                <a href="{{ route('admin.co_so_cung_cap.edit', $item->id) }}" class="btn btn-xs btn-success">Sửa</a>
                                                <a onclick="return confirm('Bạn có muốn xóa không?') ;" href="{{ route('admin.co_so_cung_cap.destroy', $item->id) }}" class="btn btn-xs btn-danger">Xóa </a>
                                            </td>
                                            <td>{{ $start_order++ }}</td>
                                            <td>{{ $item->ten }}</td>
                                            <td>{{ $item->sdt }}</td>
                                            <td>{{ $item->dia_chi }}</td>
                                        </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="6">Chưa có thông tin</td>
                                        </tr>
                                        @endif
                                        </tbody>
                                        <thead>
                                        <tr>
                                            <!--<th rowspan="2">#</th> -->
                                            <th rowspan="2" width="150px">Chức năng</th>
                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Tên cơ sở</th>
                                            <th rowspan="2">Số điện thoại</th>
                                            <th rowspan="2">Địa chỉ</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                    @if($data != null)
                                    <div class="row">
                                        <div class="col-xs-2 text-left record-show">
                                            <select id="mySelect" class="form-control select" name="paginate" onchange="this.form.submit()">
                                                <option value="10" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 10 ? 'selected' : '' }}>10 kết quả</option>
                                                <option value="20" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 20 ? 'selected' : '' }}>20 kết quả</option>
                                                <option value="30" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 30 ? 'selected' : '' }}>30 kết quả</option>
                                            </select>
                                            <p id="demo"> </p>
                                        </div> 
                                        <div class="col-xs-10 paginate text-right">
                                            <div> {{ $paginate }} </div>
                                        </div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>Xoa thanh con roi.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            @if(session()->has('message'))
                <script type='text/javascript'>
                    // $('button#show-modal-delete').click();
                    $('#show-modal-delete').click();
                    setTimeout(function () {
                        $('#myModal').modal('hide');
                    }, 2000);
                </script>
            @endif
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
                                if(document.getElementById("file-import").files.length == 0)
                                {
                                    $('#importModals .modal-body .list-errors').html('Vui lòng chọn File');
                                }else{
                                    $('#importModals .modal-body .list-errors').html('Đang tải...');
                                }
                                e.preventDefault();
                                console.log('import co so cung cap')
                // $('#importModals .modal-body .list-errors').html('Đang tải....');
                var formData = new FormData(this);

                $.ajax({
                    url: '/admin/ajax/co-so-cung-cap/import',
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
