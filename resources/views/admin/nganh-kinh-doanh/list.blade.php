@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách ngành kinh doanh
                <small>
                    <a href="{{route('admin.nganh_kinh_doanh.create')}}" class="btn btn-primary">Thêm mới</a>
                    <button class="btn btn-primary">Import</button>
                </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Danh sách ngành kinh doanh</li>
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
                            <form action="{{route('admin.nganh_kinh_doanh.list')}}" method="GET">
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
                                                        <option value="1" <?php if(isset($_GET['searchOption']) && $_GET['searchOption'] == 1) echo 'selected'; ?>>Tên</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-4 text-center">
                                                    <button class="btn btn-primary">Tìm Kiếm</button>
                                                    <a href="{{ route('admin.nganh_kinh_doanh.list') }}" class="btn btn-danger">Làm mới</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Quản lý ngành kinh doanh </h3>
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
                                        <th rowspan="2">Tên ngành</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$data->isEmpty())
                                        @foreach($data as $item)
                                    <tr style="text-align: center;">
                                        <!--<td><input type="checkbox"></td> -->
                                        <td>
                                            <a href="{{ route('admin.nganh_kinh_doanh.show', $item->id) }}" class="btn btn-xs btn-info">Xem </a>
                                            <a href="{{ route('admin.nganh_kinh_doanh.edit', $item->id) }}" class="btn btn-xs btn-success">Sửa</a>
                                            <a onclick="return confirm('Bạn có muốn xóa không?') ;" href="{{ route('admin.nganh_kinh_doanh.destroy', $item->id) }}" class="btn btn-xs btn-danger">Xóa </a>
                                        </td>
                                        <td>{{ $start_order++ }}</td>
                                        <td style="text-align: left;">{{ $item->ten_nganh }}</td>
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
                                        <th rowspan="2">Tên ngành</th>
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
        </section>
    </div>
@endsection
<script>
    function numberpage() {
            var x = document.getElementById("mySelect").value;
            document.getElementById("demo").innerHTML = x;
        }
</script>
