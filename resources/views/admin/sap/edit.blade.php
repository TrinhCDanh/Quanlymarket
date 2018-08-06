@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa sạp
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Sửa sạp</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Thông tin sạp </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form action="{{ route('admin.sap.update',['id'=>$data->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="col-sm-7">
                                                    {{-- Mã số quầy/sạp--}}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-5 control-label">Mã số quầy/sạp</label>
                                                            <div class="col-sm-6">
                                                                <input name="ma_so_sap" value="{{ isset($data) ? $data->ma_so_sap : '' }}" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Tên quầy/sạp--}}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-5 control-label">Tên quầy/sạp</label>
                                                            <div class="col-sm-6">
                                                                <input name="ten" value="{{ isset($data) ? $data->ten : '' }}" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Tên hộ kinh doanh--}}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-5 control-label">Tên hộ kinh doanh</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control select"
                                                                        name="id_ho_kinh_doanh" id="hoKinhDoanh">
                                                                        <option hidden="" value="{{ null }}"></option>
                                                                    @foreach($hoKinhDoanh as $item)
                                                                        <option hidden="" disabled="" {{$data->id_ho_kinh_doanh==$item->id ? 'selected' : ''  }} value="{{ $item->id }}">{{ $item->ten_ho_kd }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <a href="#" onclick ="change()"><div class="fa fa-remove" style="color: red;"></div></a>
                                                        </div>
                                                    </div>
                                                    {{-- Tên chợ--}}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-5 control-label">Chợ</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control select2"
                                                                        name="id_cho" required>
                                                                    <option value="">----Chợ ---</option>
                                                                    @foreach($cho as $choSap)
                                                                        <option {{$data->id_cho==$choSap->id ? 'selected' : ''  }} value="{{ $choSap->id }}">{{ $choSap->ten }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <input id="submit" value="Lưu" class="btn btn-info pull-right"
                                                                   type="submit">
                                                            <a onclick="return confirm('Quay lại danh sách sạp?');" href="{{ route('admin.sap.list') }}"
                                                               class="btn btn-info pull-right" style="margin-right: 15px">Quay
                                                                lại</a>
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
            </div>
        </section>
    </div>
@endsection
<script type="text/javascript">
    function change(){
    if (confirm('Bạn có muốn xóa tên hộ kinh doanh không?')) {
        $('#hoKinhDoanh').val(null).change();
    } else {
        // Do nothing!
    }
    
}
</script>