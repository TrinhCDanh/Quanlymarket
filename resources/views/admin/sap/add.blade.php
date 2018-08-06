@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm sạp
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thêm sạp</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Thông tin sạp </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-sm-12">
                                <div class="row">
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
                                        <form action="{{ route('admin.sap.store') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="col-sm-6">
                                                {{-- Mã số quầy/sạp--}}
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-5 control-label">Mã số quầy/sạp</label>
                                                        <div class="col-sm-7">
                                                            <input name="ma_so_sap" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Tên quầy/sạp--}}
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-5 control-label">Tên quầy/sạp</label>
                                                        <div class="col-sm-7">
                                                            <input name="ten" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Tên chợ--}}
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-5 control-label">Chợ</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control select2"
                                                                    name="id_cho" required>
                                                                <option value="">----Chợ ---</option>
                                                                @foreach($cho as $choSap)
                                                                    <option value="{{ $choSap->id }}">{{ $choSap->ten }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <input value="Lưu" class="btn btn-info pull-right"
                                                               type="submit">
                                                        <a onclick="return confirm('Quay lại danh sách sạp?') ;" href="{{ route('admin.sap.list') }}"
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
        </section>
    </div>
@endsection
