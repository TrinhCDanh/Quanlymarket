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
            <li class="active">User Permission</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách chức năng </h3>
                        {{message()}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ route('admin.user.add') }}" class="btn btn-info">Tạo nhóm </a>
                                </div>
                            </div>
                        </div> -->
                        {{message()}}
                        <form method="post" action="{{route('admin.group.permission', ['id'=>$id])}}">
                            {{ csrf_field() }}
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="100px">#</th>
                                    <th width="50%">Chức năng</th>
                                    <th><input class="checkall" id="checkall" type="checkbox"/></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($resources)
                                    @foreach($resources as $key => $item)
                                        <?php
                                            if(!$item) return false;
                                            $name = str_replace('_',' ',$item);
                                            $name = str_replace('.',' ',$name);
                                            $name = str_replace('-',' ',$name);
                                        ?>
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ ucfirst($name)  }}</td>
                                            <td><input type="checkbox" name="permission[]" class="cid" {{in_array($item,$permission)?'checked':''}}  value="{{$item}}"></td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><button class="btn btn-info">Save</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$('.checkall').click(function() {
    $(':checkbox').prop('checked',this.checked);
});
</script>
@endsection