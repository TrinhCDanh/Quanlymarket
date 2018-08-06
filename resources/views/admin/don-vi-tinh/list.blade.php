@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách đơn vị tính
                <small>
            <a class="btn btn-success" href="{{route('admin.don-vi-tinh.create')}}"> Thêm mới </a>
                </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Danh sách đơn vị tính</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content table-border">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Quản lý đơn vị tính </h3>
                            <small>Hiển thị {{ $countPerPage.' / '.$count }} tổng số dữ liệu</small>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body custom-table">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <!--<th rowspan="2">#</th> -->
                                        <th rowspan="2" width="150px">Chức năng</th>
                                        <th rowspan="2">STT</th>
                                        <th rowspan="2">Tên</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$data->isEmpty())
                                        @foreach($data as $item)
                                    <tr style="text-align: center;">
                                        <!--<td><input type="checkbox"></td>-->
                                        <td>
                                            <a href="{{ route('admin.don-vi-tinh.show', $item->id) }}" class="btn btn-xs btn-info">Xem </a>
                                            <a href="{{ route('admin.don-vi-tinh.edit', $item->id) }}" class="btn btn-xs btn-success">Sửa</a>
                                            <a onclick="return confirm('Bạn có muốn xóa không?') ;" href="{{ route('admin.don-vi-tinh.destroy', $item->id) }}" class="btn btn-xs btn-danger">Xóa </a>
                                        </td>
                                        <td>{{ $start_order++}}</td>
                                        <td>{{ $item->ten }}</td>
                                    </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="6">Chưa có thông tin</td>
                                    </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
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
                                        <div> {{ $data->links() }} </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('footer')
<script>
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
                                console.log('import ho khau')
                // $('#importModals .modal-body .list-errors').html('Đang tải....');
                var formData = new FormData(this);

                $.ajax({
                    url: '/admin/ajax/don-vi-tinh/import',
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        $('#importModals .modal-body .list-errors').html('');
                        if (data.code == 200) {
                            $('#importModals').modal('hide');
                            alert('Import success');
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