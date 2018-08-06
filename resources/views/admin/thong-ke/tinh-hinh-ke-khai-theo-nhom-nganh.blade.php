@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tình hình kinh doanh theo nhóm ngành
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Tình hình kinh doanh theo nhóm ngành</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content table-border">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Chức năng </h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                        <div class="row">
                                              <div class="col-md-12">
                                               <div class="row">
                                                <form action="" method="GET">
                                                    <div class="col-md-4">
                                                       <select class="form-control" name="cho" id="">
                                                        <option value="">Chọn tên chợ</option>
                                                          @forelse($listCho as $cho)
                                                          <option value="{{$cho->id}}" {{ (collect(Input::get('cho'))->contains($cho->id)) ? 'selected':'' }}>{{$cho->ten}}</option>
                                                          @empty
                                                          @endforelse
                                                       </select>
                                                   </div>
                                                   <div class="col-md-4">
                                                       <select class="form-control" name="nganh" id="">
                                                        <option value="">Chọn tên nhóm ngành</option>
                                                           @forelse($listNganhKinhDoanh as $nganh)
                                                          <option value="{{$nganh->id}}" {{ (collect(Input::get('nganh'))->contains($nganh->id)) ? 'selected':'' }}>{{$nganh->ten_nganh}}</option>
                                                          @empty
                                                          @endforelse
                                                       </select>
                                                   </div>
                                                   <div class="col-md-4">
                                                       <button class="btn btn-warning btn-block pull-right">Lọc</button>
                                                   </div>
                                                </form>
                                                   
                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                <form method="get" action="">
                                    <div class="form-group">
                                        <div class="row">
                                           
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input class="form-control" name="key" placeholder="Từ khóa">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <select class="form-control" name="type">
                                                            <option value="0">All</option>
                                                            <option value="1">Tên hộ KD</option>
                                                            <option value="2">Số GCN DKKD</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <select class="form-control" name="sort">
                                                            <option value="asc">Tăng dần</option>
                                                            <option value="desc">Giảm dần</option>

                                                        </select>
                                                    </div>
                                                   {{-- <div class="col-sm-2">
                                                        <select class="form-control" name="phuong" id="id_phuong_tim_kiem">
                                                            <option value="">Phường</option>
                                                            @foreach($listPhuong as $phuong)
                                                                <option value="{{ $phuong->id }}">{{ $phuong->ten }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>--}}
                                                    <div class="col-sm-2">
                                                        <select class="form-control" name="cho" id="id_cho_tim_kiem">
                                                            <option value="">Chợ</option>
                                                            @foreach($listCho as $cho)
                                                                <option value="{{ $cho->id }}">{{ $cho->ten }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select class="form-control" name="nganh">
                                                            <option value="">Ngành nghề kinh doanh</option>
                                                            @foreach($listNganhKinhDoanh as $kd)
                                                                <option value="{{ $kd->id }}">{{ $kd->ten_nganh }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-info pull-right margin-r-5">Tìm kiếm
                                                        </button>
                                                        <a  href="{{ route('admin.thong_ke.tinh_hinh_ke_khai_theo_nhom_nganh') }}" class=" margin-r-5 btn btn-danger pull-right">Làm mới
                                                        </a>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                @if((!Input::has('nganh') && !Input::has('nganh')) || (Input::get('nganh') == '' && Input::get('cho') == ''))
                                <h3 class="box-title">Tình hình kê khai theo tất cả các chợ và ngành </h3>
                                @elseif(Input::has('nganh') && (!Input::has('cho') || Input::get('cho') == ''))
                                 <h3 class="box-title">Tình hình kê khai theo ngành {{collect($listNganhKinhDoanh)->where('id',Input::get('nganh'))->first()->ten_nganh}} và tất cả các chợ </h3>
                                @elseif(Input::has('cho') && (!Input::has('nganh') || Input::get('nganh') == ''))
                                <h3 class="box-title">Tình hình kê khai theo tất cả ngành và của {{collect($listCho)->where('id',Input::get('cho'))->first()->ten}}  </h3>
                                @else
                                <h3 class="box-title">Tình hình kê khai theo ngành {{collect($listNganhKinhDoanh)->where('id',Input::get('nganh'))->first()->ten_nganh}} và {{collect($listCho)->where('id',Input::get('cho'))->first()->ten}}</h3>
                                @endif
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body custom-table">
                                <div class="table-responsive">
                                    <table class="table table-hover" style="min-width: 1500px;">
                                        <thead>
                                        <tr>

                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Họ tên chủ hộ KD</th>
                                            @if(!Input::has('cho') || Input::get('cho') == '')
                                            <th rowspan="2">Tên Chợ</th>
                                            @endif
                                            <th rowspan="2">Mã quầy/sạp</th>
                                            <th rowspan="2">GCN ĐKKD</th>
                                            <th colspan="2">GCN ATTP</th>
                                            @if(!Input::has('nganh') || Input::get('nganh') == '')
                                            <th rowspan="2">Nghành KD</th>
                                            @endif
                                            <th rowspan="2">Mặt hàng KD</th>
                                            <th rowspan="2">Đơn vị cung cấp</th>
                                            <th rowspan="2">Địa chỉ cung cấp</th>
                                            <th rowspan="2">Lượng hàng BQ nhập vào chợ</th>
                                            <th rowspan="2">Giấy tờ chứng minh nguồn gốc</th>
                                            <th rowspan="2">Ghi chú</th>
                                        </tr>
                                        <tr>
                                            <th>Số GCN</th>
                                            <th>Thời gian
                                                hiệu lực
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($list))
                                            @foreach($list as $item)
                                                @php $count_mat_hang_kinh_doanh = count($item->mat_hang_kinh_doanh) 
                                                    
                                                @endphp
                                                @foreach($item->mat_hang_kinh_doanh as $key => $mat_hang_kd )

                                                    <tr>

                                                        <td>{{ $start_order++ }}</td>
                                                        @if($key === 0)
                                                            <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $item->ten_ho_kd }}</td>
                                                           @if(!Input::has('cho') || Input::get('cho') == '')
                                                            <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $item->getCho->ten }}</td>
                                                            @endif
                                                            <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $item->ma_sap }}</td>
                                                            <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $item->ma_so_ho_kd }}</td>
                                                            <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $item->ma_so_giay_ATTP }}</td>
                                                            <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $item->thoi_gian_hieu_luc_ATTP }}</td>
                                                            @if(!Input::has('nganh') || Input::get('nganh') == '')
                                                            <td rowspan="{{ $count_mat_hang_kinh_doanh }}">{{ $mat_hang_kd->getNganhKinhDoanh['ten_nganh'] }}</td>
                                                            @endif
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
            </div>
        </section>
    </div>
@endsection
