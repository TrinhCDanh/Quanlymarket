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
                <li class="active">Group User</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách nhóm </h3>
                            {{message()}}
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('admin.group.add') }}" class="btn btn-info">Tạo nhóm </a>
                                    </div>
                                </div>
                            </div>
                            {{message()}}
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Tên nhóm</th>
                                  <th>Phân quyền</th>
                                  <th>Trạng thái</th>
                                  <th>Ngày tạo</th>
                                  <th>Ngày thay đổi</th>
                                  <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($data)
                                  @foreach($data as $item)
                                      <tr>
                                      <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td><a href="{{route('admin.group.permission',['id'=>$item->id])}}">Đặt quyền</a></td>
                                        <td>{!!status_default($item->status)!!}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->updated_at}}</td>
                                        <td align="center">
                                          <a href="{{route('admin.group.edit',['id'=>$item->id])}}"><i class="fa fa-edit text-info"></i></a>&nbsp;&nbsp;
                                          <a onclick="return confirm('You sure to delete ?')" href="{{route('admin.group.delete',['id'=>$item->id])}}"><i class="fa fa-remove text-danger"></i></a>
                                        </td>
                                      </tr>
                                  @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
