@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Xem sạp
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Xem sạp</li>
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
                                            <form>
                                                {{ csrf_field() }}
                                                <div class="col-sm-6">
                                                    {{-- Mã số quầy/sạp--}}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-5 control-label">Mã số quầy/sạp</label>
                                                            <div class="col-sm-7">
                                                                <input name="ma_so_sap" value="{{ isset($data) ? $data->ma_so_sap : '' }}" class="form-control" disabled="" 
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Tên quầy/sạp--}}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-5 control-label">Tên quầy/sạp</label>
                                                            <div class="col-sm-7">
                                                                <input name="ten_sap" value="{{ isset($data) ? $data->ten : '' }}" class="form-control" disabled="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Tên chợ--}}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-5 control-label">Chợ</label>
                                                            <div class="col-sm-7">
                                                                <input name="id_cho" value="{{ isset($data) ? $data->cho['ten'] : '' }}" class="form-control" disabled="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <a href="{{ route('admin.sap.list') }}"
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
