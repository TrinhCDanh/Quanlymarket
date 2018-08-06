@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm chợ
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thêm chợ</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Thông tin chợ </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="{{ isset($id) ? route('admin.cho.update',$id) : route('admin.cho.update') }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="col-sm-6">
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-5 control-label">Tên chợ</label>
                                                        <div class="col-sm-7">
                                                            <input name="ten" value="{{old('ten')}}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-5 control-label">Địa chỉ chợ</label>
                                                        <div class="col-sm-7">
                                                            <input name="dia_chi" value="{{old('dia_chi')}}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <input value="Lưu" class="btn btn-info pull-right"
                                                               type="submit">
                                                        <a href="{{ route('admin.sap.list') }}"
                                                           class="btn btn-info pull-right" style="margin-right: 15px">Quay
                                                            lại</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                         <div class="col-sm-12">
                                              @if(session()->has('success'))
                                             <!--  <div class="alert alert-success">
                                                    Cập nhật thành công !
                                                </div> -->
                                                @endif
                                                   @if(session()->has('error'))
                                              <div class="alert alert-danger">
                                                    Thêm thất bại !
                                                </div>
                                                @endif
                                                
                                                </div>
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
