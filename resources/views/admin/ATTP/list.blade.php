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

                    <div class="box box-solid box-primary">
                    <!-- .box-header -->
                    <div class="box-header">
                        <h3 class="box-title">Bộ lọc</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- .box-body -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input class="form-control" placeholder="Từ Khóa">
                                    </div>
                                    <div class="col-xs-4">
                                        <select class=" form-control">
                                            <option>All</option>
                                            <option>Số Hộ KD</option>
                                            <option>Tên Hộ KD</option>
                                            <option>Số GCN ĐKKD</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <button class="btn btn-primary">Tìm Kiếm</button>
                                    </div>
                                </div>
                            </div>
                            <!-- excel export -->
                            <div class="col-xs-4">
                                <div class="row">
                                    <div class="col-xs-8 text-right custom-select-excel">
                                        <select class="form-control select-excel">
                                            <option>Excel</option>
                                            <option>PDF</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <button class="btn btn-primary" style="width: 73px">Export</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.excel export -->
                        </div>
                        <div class="row mt-10">
                            <div class="col-xs-8">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <select class=" form-control">
                                            <option>Chợ</option>
                                            <option>Điện Thoại</option>
                                            <option>Email</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select class=" form-control">
                                            <option>Ngành Nghề Kinh Doanh</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <button class="btn btn-primary" style="width: 80px">Lọc</button>
                                    </div>
                                </div>
                            </div>
                            <!-- excel export -->
                            <div class="col-xs-4">
                                <div class="row">
                                    <div class="col-xs-4 text-right custom-select-excel">
                                        <select class="form-control select-excel">
                                            <option>Tăng Dần</option>
                                            <option>Giảm Dần</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 text-right custom-select-excel">
                                        <select class="form-control select-excel">
                                            <option>Chọn cột</option>
                                            <option>Tên chủ hộ</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <button class="btn btn-primary" style="width: 73px">Sắp xếp</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.excel export -->
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Hồ sơ quản lí ATTP</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body custom-table">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 1500px;">
                                    <thead>
                                    <tr>

                                        <th rowspan="2">STT</th>
                                        <th rowspan="2">Họ tên chủ hộ KD</th>
                                        <th rowspan="2">Mã quầy/sạp</th>
                                        <th rowspan="2">GCN ĐKKD</th>
                                        <th rowspan="2">Mặt hàng KD</th>
                                        <th rowspan="2">Đơn vị cung cấp</th>
                                        <th rowspan="2">Địa chỉ cung cấp</th>
                                        <th rowspan="2">Lượng hàng BQ nhập vào chợ</th>
                                        <th rowspan="2">Giấy tờ chứng minh nguồn gốc</th>
                                        <th rowspan="2">Ghi chú</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($list))
                                        @foreach($list as $item)
                                            @php $count_mat_hang_kinh_doanh = count($item->mat_hang_kinh_doanh) @endphp
                                            @foreach($item->mat_hang_kinh_doanh as $key => $mat_hang_kd )

                                                <tr>

                                                    <td>{{ $start_order++ }}</td>
                                                    @if($key === 0)
                                                        <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $item->ten_ho_kd }}</td>
                                                        <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $item->ma_sap }}</td>
                                                        <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $item->ma_so_ho_kd }}</td>
                                                    @endif
                                                    <td>{{ $mat_hang_kd->ten }}</td>
                                                    <td>{{ isset($mat_hang_kd->getCoSoCungCap) ?$mat_hang_kd->getCoSoCungCap->ten :'' }}</td>
                                                    <td>{{ isset($mat_hang_kd->getCoSoCungCap) ?$mat_hang_kd->getCoSoCungCap->dia_chi :'' }}</td>
                                                    <td>{{ $mat_hang_kd->luong_hang_bq_nhap }}</td>
                                                    <td>{{ $mat_hang_kd->ten_giay_chung_nhan }}</td>
                                                    <td>{{ $mat_hang_kd->ghi_chu }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                                {!! $paginate !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
