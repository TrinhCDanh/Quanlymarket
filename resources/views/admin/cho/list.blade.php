@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
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
                            <form action="{{route('admin.cho.list')}}" method="GET">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="row text-center">
                                                <div class="col-md-6">

                                                     <input name="searchValue" class="form-control" placeholder="Từ Khóa" value="{{old('searchValue')}}">
                                                
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn btn-primary">Tìm Kiếm</button>
                                                    <a href="{{ route('admin.cho.list')}}" class="btn btn-danger">Làm mới</a>

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
                    @if(Session::has('error'))
                        <div class="alert alert-error">
                            <b style="text-align: center">{!! Session::get('error') !!}</b>
                        </div>
                    @endif
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách chợ  </h3>
                            @if(Input::has("searchValue"))
                                <small>{{count($data)}} kết quả tìm kiếm</small>
                            @else
                                @if($all <= 10)
                                    <small>Hiển thị {{$all.'/ '. $all }} tổng số dữ liệu</small>
                                    @else
                             <small>Hiển thị {{ isset($_GET['paginate']) && $_GET['paginate'] != -1  ? $_GET['paginate'] .'/ '. $all : isset($_GET['paginate']) && $_GET['paginate'] == -1 ? 'tất cả' : '10' .'/ '. $all }} tổng số dữ liệu</small>
                            @endif
                                @endif
                        
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <a href="{{ route('admin.cho.add') }}" class="btn btn-info">Tạo chợ </a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Địa chỉ </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $index => $item)
                                    <tr>
                                        <td>{{ $index +1}}</td>
                                        <td>{{ $item->ten}}</td>
                                        <td>{{ $item->dia_chi}}</td>
                                        <td>

                                            <a href="{{route('admin.cho.edit',$item->id)}}" class="btn btn-success btn-xs">Cập nhật </a>
                                             <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{route('admin.cho.delete',$item->id)}}" class="btn btn-danger btn-xs">xóa </a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                            
                        </div>
                        <div class="box-body row">
                            <div class="col-xs-2 text-left record-show">
                                <form action="" action="GET">
                                <select id="mySelect" class="form-control select" name="paginate" onchange="this.form.submit()">
                                    <option value="10" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 10 ? 'selected' : '' }}>10 kết quả</option>
                                    <option value="20" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 20 ? 'selected' : '' }}>20 kết quả</option>
                                    <option value="30" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 30 ? 'selected' : '' }}>30 kết quả</option>
                                   {{-- <option value="-1" {{ isset($_GET['paginate'])&& $_GET['paginate'] == -1 ? 'selected' : '' }}>Tất cả kết quả</option> --}}
                                </select>
                            </form>
                            </div> 
                            <div class="col-xs-10 paginate text-right">
                                <div> {{ $data->links() }} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(function(){
            setTimeout(function (){$('.alert-success').slideUp("slow");},1500);
            setTimeout(function (){$('.alert-error').slideUp("slow");},1500);

        })
    </script>
@endsection
