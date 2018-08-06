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
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách user </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('admin.user.add') }}" class="btn btn-info">Tạo user </a>
                                    </div>
                                </div>
                            </div>
                            {{message()}}
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Quyền</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $item)
                                    <tr>
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->name}}</td>
                                        <td>{{ $item->email}}</td>
                                        <td>{{ isset($item->group) ? $item->group->name : 'N/A'}}</td>
                                        <td>
                                            <a href="{{ route('admin.user.edit',['id'=>$item->id]) }}" class="label label-success">Cập nhật </a>
                                            @if($item->id!=1)
                                            <a onclick="return confirm('Bạn có muốn xóa không?') ;" href="{{ route('admin.user.delete',['id'=>$item->id]) }}" class="label label-danger">Xóa </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $list->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
