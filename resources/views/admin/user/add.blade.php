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
                            <form action="{{ route('admin.user.save') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="row">
                                        <input name="name" class="form-control" value="{{ old('name') }}"  placeholder="Username">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <input name="email" class="form-control" value="{{ old('email') }}"  placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <input name="password" class="form-control" type="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <select name="id_group" class="form-control">
                                            @foreach($group as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <input value="submit" class="btn btn-info" type="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
