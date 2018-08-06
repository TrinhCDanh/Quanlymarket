@extends('admin.master') @section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mặt hàng kinh doanh
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Thêm mặt hàng kinh doanh</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Thông tin mặt hàng kinh doanh </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="{{ empty($id) ? route('admin.mat_hang_kinh_doanh.create', $id_ho) : route('admin.mat_hang_kinh_doanh.edit', [$id_ho, $id])}}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$id}}" name="id_sp">
                                        <div class="col-sm-6">
                                            {{-- Tên cơ sở cung cấp --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Tên mặt hàng</label>
                                                    <div class="col-sm-7">
                                                        <input name="ten" class="form-control" value="{{isset($data->ten) ? $data->ten : old('ten')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Số điện thoại --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Lượng hàng nhập</label>
                                                    <div class="col-sm-7">
                                                        <input type="number" name="luong_hang_bq_nhap" class="form-control" value="{{isset($data->luong_hang_bq_nhap) ? $data->luong_hang_bq_nhap : old('luong_hang_bq_nhap')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Ghi chú--}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Ghi chú</label>
                                                    <div class="col-sm-7">
                                                        <input name="ghi_chu" class="form-control" value="{{isset($data->ghi_chu) ? $data->ghi_chu : old('ghi_chu')}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Tên giấy CN</label>
                                                    <div class="col-sm-7">
                                                        <input name="ten_giay_chung_nhan" class="form-control" value="{{isset($data->ten_giay_chung_nhan) ? $data->ten_giay_chung_nhan : old('ten_giay_chung_nhan')}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Url GCN</label>
                                                    <div class="col-sm-7">
                                                        <input type="file" name="url_giay_chung_nhan" class="form-control" >
                                                        <!-- <input name="url_giay_chung_nhan" class="form-control" value="{{isset($data->url_giay_chung_nhan) ? $data->url_giay_chung_nhan : old('url_giay_chung_nhan')}}"> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            {{-- Hộ KD --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Hộ KD</label>
                                                    <div class="col-sm-7">
                                                        <input type="hidden" name="id_ho_kd" value="{{$hoKinhDoanh->id}}">
                                                        <input type="text" readOnly class="form-control" value="{{$hoKinhDoanh->ten_ho_kd}}">
                                                        <!-- <select class="form-control" name="id_ho_kd" readOnly>
                                                            <option value="{{$hoKinhDoanh->id}}">{{$hoKinhDoanh->ten_ho_kd}}</option>
                                                        </select> -->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Cơ sở cung cấp</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="id_co_so_cc">
                                                            <option value="">Chọn cơ sở cung cấp</option>
                                                            @forelse($coSocoSoCungCapCC as $item)
                                                                <option value="{{$item->id}}" {{isset($data) && $item->id == $data->id_co_so_cc || old('id_co_so_cc')==$item->id ? "selected" : ''}}>{{$item->ten}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Đơn vị</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="id_don_vi">
                                                            <option value="">Chọn đơn vị</option>
                                                            @forelse($donViTinh as $item)
                                                                <option value="{{$item->id}}" {{isset($data) && $item->id == $data->id_don_vi || old('id_don_vi')==$item->id ? "selected" : ''}}>{{$item->ten}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Ngành KD</label>
                                                    <div class="col-sm-7">
                                                        <input type="hidden" name="id_nganh_kd" value="{{isset($nganhKD->id) ? $nganhKD->id : 1}}">
                                                        <input type="text" readOnly class="form-control" value="{{isset($nganhKD->ten_nganh) ? $nganhKD->ten_nganh : 'N/A'}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Sạp</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="id_sap">
                                                            <option value="">Chọn sạp</option>
                                                            @forelse($sap as $item)
                                                                <option value="{{$item->id}}" {{isset($data) && $item->id == $data->id_sap || old('id_sap')==$item->id ? "selected" : ''}}>{{$item->ten}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <input value="Lưu" class="btn btn-info pull-right" type="submit">
                                                    <a href="{{ route('admin.mat_hang_kinh_doanh.list', $id_ho) }}" class="btn btn-info pull-right"
                                                        style="margin-right: 15px">Quay lại
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection