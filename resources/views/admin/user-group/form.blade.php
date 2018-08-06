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
          <div class="col-sm-12">

              <div class="box">
                  <div class="box-header">
                      <h3 class="box-title">Thêm tài khoản </h3>
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
                        <form action="{{!empty($group) ? route('admin.group.edit', ['id'=>$group->id]) : route('admin.group.add')}}" method="post">
                          {{ csrf_field() }}
                          <div class="row">
                            <div class="col-md-6">
                            
                              <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>Tên nhóm</label>
                                <input type="text" value="{{isset($group->name) ? $group->name : old('name')}}" class="form-control" name="name">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                              </div>
                              
                              <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label>Trạng thái</label> 
                                <select class="form-control" name="status">
                                  <option value="1" {{isset($group->status)&& $group->status==1 ? 'selected' : ''}}>Hiện</option>
                                  <option value="0" {{isset($group->status)&& $group->status==0 ? 'selected' : ''}}>Ẩn</option>
                                </select>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>

                          
                            <div class="col-md-12">
                              <button class="btn btn-primary" type="submit">Lưu</button>
                              <a class="btn btn-default" href="{{route('admin.group.list')}}">Trở về</a>
                            </div>
                          </div>
                          
                          <!-- /.row -->
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
 
@endsection