@extends('admin.master') @section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa đơn vị tính
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Sửa đơn vị tính</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Thông tin đơn vị tính </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="{{ route('admin.don-vi-tinh.update',['id'=>$data->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="col-sm-6">
                                            {{-- Tên đơn vị tính --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-5 control-label">Tên đơn vị tính</label>
                                                    <div class="col-sm-7">
                                                        <input name="ten" value="{{ isset($data) ? $data->ten : '' }}" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <input value="Sửa" class="btn btn-info pull-right" type="submit">
                                                    <a onclick="return confirm('Quay lại danh sách đơn vị tính?') ;" href="{{ route('admin.don-vi-tinh.list') }}" class="btn btn-info pull-right"
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