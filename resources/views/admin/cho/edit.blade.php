@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>

                {{Request::segment(3) == 'add' ? 'Thêm' : 'Sửa'}} chợ
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Sửa chợ</li>
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
                                        <form action="{{ route('admin.cho.update',$id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="col-sm-6">
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-5 control-label">Tên chợ</label>
                                                        <div class="col-sm-7">
                                                            <input name="ten" value="{{ isset($data) ? $data->ten : old('ten') }}" class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-5 control-label">Địa chỉ chợ</label>
                                                        <div class="col-sm-7">
                                                            <input name="dia_chi" value="{{ isset($data) ? $data->dia_chi : old('dia_chi') }}" class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <input value="Lưu" class="btn btn-info pull-right"
                                                               type="submit">
                                                        <a onclick="return confirm('Quay lại danh sách chợ?') ;" href="{{ route('admin.cho.list') }} "
                                                           class="btn btn-info pull-right" style="margin-right: 15px">Quay
                                                            lại</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                         <div class="col-sm-12">
                                             
                                                   @if(session()->has('error'))
                                              <div class="alert alert-danger">
                                                    session()->get('error');
                                                </div>
                                                @endif
                                                @if ($errors->any())
                                        <div class="alert alert-danger">
                                                 <ul>
                                                     @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                     @endforeach
        </ul>
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
