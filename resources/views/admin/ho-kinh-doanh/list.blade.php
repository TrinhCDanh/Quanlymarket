@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh Sách Hộ Kinh Doanh
                <!-- <small>
                    <button class="btn btn-primary">Tạo mới</button>
                </small>
                <small>
                    <button class="btn btn-primary">Import</button>
                </small> -->
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content table-border">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách hộ kinh doanh </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body custom-table">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="">
                                    <tr>
                                        <!-- <th style="width:30px">
                                            <input type="checkbox">
                                        </th> -->
                                        <th style="width: 130px">Chức Năng</th>
                                        <th style="width: 50px;">STT</th>
                                        <th>Số Hộ KD</th>
                                        <th >Tên hộ kinh doanh</th>
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
                                            <!-- <td><input type="checkbox"></td> -->
                                            <td>
                                                <a href="{{ route('admin.mat_hang_kinh_doanh.list', $item->id) }}" class="btn btn-primary btn-xs">Chi tiết</a>
                                            </td>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->ma_so_ho_kd}}</td>
                                            <td>{{$item->ten_ho_kd}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Chức Năng</th>
                                        <th>STT</th>
                                        <th>Số Hộ KD</th>
                                        <th>Tên hộ kinh doanh</th>
                                        
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
                                <!-- <div class="col-xs-2 text-left record-show">
                                    <select id="mySelect" class="form-control select" name="paginate" onchange="this.form.submit()">
                                        <option value="10" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 10 ? 'selected' : '' }}>10 kết quả</option>
                                        <option value="20" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 20 ? 'selected' : '' }}>20 kết quả</option>
                                        <option value="30" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 30 ? 'selected' : '' }}>30 kết quả</option>
                                    </select>
                                    <p id="demo"> </p>
                                </div> -->
                                <div class="col-xs-10 paginate text-right">
                                    {{ $list->links() }}
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
