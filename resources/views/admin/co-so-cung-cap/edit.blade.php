@extends('admin.master') @section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa cơ sở cung cấp
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Sửa cơ sở cung cấp</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Thông tin cơ sở cung cấp </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="{{ route('admin.co_so_cung_cap.update',['id'=>$data->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="col-sm-6">
                                            {{-- Tên cơ sở cung cấp --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Tên cơ sở cung cấp</label>
                                                    <div class="col-sm-7">
                                                        <input name="ten" value="{{ isset($data) ? $data->ten : '' }}" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Số điện thoại --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Số điện thoại</label>
                                                    <div class="col-sm-7">
                                                        <input name="sdt" value="{{ isset($data) ? $data->sdt : '' }}" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Địa chỉ --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Địa chỉ</label>
                                                    <div class="col-sm-7">
                                                        <input name="dia_chi" value="{{ isset($data) ? $data->dia_chi : '' }}" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <input value="Sửa" class="btn btn-info pull-right" type="submit">
                                                    <a onclick="return confirm('Quay lại danh sách cơ sở cung cấp?');" href="{{ route('admin.co_so_cung_cap.list') }}" class="btn btn-info pull-right"
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