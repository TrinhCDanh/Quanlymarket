
@extends('admin.master') @section('content')
<style>
.no-padding{
    padding: 0px;
}

/* .box {
  background: #666666;
  color: #ffffff;
  width: 250px;
  padding: 10px;
  margin: 1em auto;
} */

input[type="checkbox"] {
  /* visibility: hidden; */
  display: none;
}
label {
  cursor: pointer;
}
input[type="checkbox"] + label:before {
  border: 1px solid #333;
  content: "\00a0";
  display: inline-block;
  font: 16px/1em sans-serif;
  height: 16px;
  margin: 0 .25em 0 0;
  padding: 0;
  vertical-align: top;
  width: 16px;
}
input[type="checkbox"]:checked + label:before {
  background: #fff;
  color: #333;
  content: "\2713";
  text-align: center;
}
input[type="checkbox"]:checked + label:after {
  font-weight: bold;
}

input[type="checkbox"]:focus + label::before {
    outline: rgb(59, 153, 252) auto 5px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh Sách Mặt Hàng Kinh Doanh
            <!-- <small>
                <button class="btn btn-primary">Tạo mới</button>
            </small>
            <small>
                <button class="btn btn-primary">Import</button>
            </small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Danh sách mặt hàng kinh doanh</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content table-border">
        <div class="row">
            <div class="col-xs-12">
                {{message()}}
                <div class="box box-solid box-primary">
                    <!-- .box-header -->
                    <div class="box-header">
                        <h3 class="box-title">Thông tin sạp </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- .box-body -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-1 no-padding">
                                    <label>Chợ</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{isset($ho_info->getCho) ? $ho_info->getCho->ten : ''}}" readonly>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Số quầy KD</label>
                                </div>
                                <div class="col-xs-2">
                                    <?php 
                                    $str = '';
                                    if(isset($ho_info->getSap)){
                                        foreach($ho_info->getSap as $item){
                                            $str .= $item->ten.', ';
                                        }
                                    }
                                    ?>
                                    <input class="form-control" placeholder="Từ Khóa" readonly value="{{$str}}">
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Tầng</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{$ho_info->tang}}" readonly>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Tên chủ hộ KD</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{$ho_info->ten_ho_kd}}" readonly>
                                </div>

                            </div>

                            <div class="col-xs-12 mt-10">

                                <div class="col-xs-1 no-padding">
                                    <label>Số điện thoại</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{$ho_info->sdt_ho_kd}}" readonly>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Ngành nghề KD chính</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{isset($ho_info->getNganhKinhDoanh) ? $ho_info->getNganhKinhDoanh->ten_nganh : 'N/A'}}" readonly>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Số GCN ĐKKD</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{$ho_info->ma_so_ho_kd}}" readonly>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Ngày cấp</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{date('d/m/Y', strtotime($ho_info->ngay_thay_doi))}}" readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 mt-10">
                                <div class="col-xs-1 no-padding">
                                    <label>Số giấy tờ ATTP</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{$ho_info->ma_so_giay_ATTP}}" readonly>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Nơi cấp</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{$ho_info->noi_cap_giay_ATTP}}" readonly>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Ngày cấp</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{$ho_info->ngay_cap_giay_ATTP != '' ? date('d/m/Y', strtotime($ho_info->ngay_cap_giay_ATTP)) : 'N/A'}}" readonly>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Thời gian hiệu lực</label>
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" placeholder="Từ Khóa" value="{{$ho_info->thoi_gian_hieu_luc_ATTP != '' ? date('d/m/Y', strtotime($ho_info->thoi_gian_hieu_luc_ATTP)) : ''}}" readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 mt-10">
                                <div class="col-xs-1 no-padding">
                                    <label>Khám sức khỏe</label>
                                </div>
                                <div class="col-xs-2">
                                    <input type="checkbox" id="c1" name="cb" {{$ho_info->kham_suc_khoe==1 ? 'checked' : ''}}>
                                    <label for="c0"></label>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Giấy xác nhận kiến thức</label>
                                </div>
                                <div class="col-xs-2">
                                    <input type="checkbox" id="c1" name="cb" {{$ho_info->giay_xac_nhan_kien_thuc==1 ? 'checked' : ''}}>
                                    <label for="c0"></label>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>GCN đủ điều kiện</label>
                                </div>
                                <div class="col-xs-2">
                                    <input type="checkbox" id="c1" name="cb" {{$ho_info->GCN_du_dieu_kien==1 ? 'checked' : ''}}>
                                    <label for="c0"></label>
                                </div>

                                <div class="col-xs-1 no-padding">
                                    <label>Bản cam kết đảm bảo ATTP</label>
                                </div>
                                <div class="col-xs-2">
                                    <input type="checkbox" id="c1" name="cb" {{$ho_info->ban_cam_ket_dam_bao==1 ? 'checked' : ''}}>
                                    <label for="c0"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-solid box-primary">
                    <!-- .box-header -->
                    <div class="box-header">
                        <h3 class="box-title">Bộ lọc </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- .box-body -->
                    <div class="box-body">
                        <div class="row mt-10">
                        <form method="get" action="">
                            <div class="col-xs-12">
                                <div class="col-xs-1 no-padding">
                                    <input class="form-control" placeholder="Từ Khóa" name="key" value="{{isset($_GET['key']) ? $_GET['key'] : ''}}">
                                </div>
                                <div class="col-xs-2">
                                    <select class=" form-control">
                                        <option>Tên mặt hàng</option>
                                        <!-- <option>Điện Thoại</option>
                                        <option>Email</option> -->
                                    </select>
                                </div>
                                <div class="col-xs-1 no-padding">
                                    <button class="btn btn-primary btn-block">Tìm</button>
                                </div>
                                <div class="col-lg-2 col-md-0 col-sm-0 col-xs-0">
                                    <!-- <select class=" form-control" name="cho">
                                        <option value="">Chợ</option>
                                        @forelse($cho as $item)
                                            <option value="{{$item->id}}">{{$item->ten}}</option>
                                        @empty
                                        @endforelse
                                    </select> -->
                                    <!-- <select class=" form-control" name="nganh">
                                        <option value="">Cơ sở cung cấp</option>
                                        @forelse($coSoCungCap as $item)
                                            <option value="{{$item->id}}">{{$item->ten}}</option>
                                        @empty
                                        @endforelse
                                    </select> -->
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select class="form-control" name="sort">
                                        <option value="ASC" {{(isset($_GET['sort']) && $_GET['sort'] == 'ASC') ? 'selected' : ''}}>Tăng dần</option>
                                        <option value="DESC" {{(isset($_GET['sort']) && $_GET['sort'] == 'DESC') ? 'selected' : ''}}>Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 col-xs-2 no-padding">
                                    <select class=" form-control" name="sap">
                                        <option value="">Sạp</option>
                                        @forelse($sap as $item)
                                            <option value="{{$item->id}}" {{(isset($_GET['sap']) && $_GET['sap'] == $item->id) ? 'selected' : ''}}>{{$item->ten}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-lg-1 col-xs-2">
                                    <button class="btn btn-primary btn-block" type="submit">Lọc</button>
                                </div>
                                <div class="col-lg-1 col-xs-2 no-padding">
                                    <a href="{{ route('admin.mat_hang_kinh_doanh.list', $id_ho) }}">
                                        <button class="btn btn-primary btn-block" type="button">Làm mới</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="row mt-10">
                            <div class="col-xs-12">
                                <div class="col-lg-1 col-xs-2 no-padding">
                                    <a href="{{ route('admin.mat_hang_kinh_doanh.create', $id_ho) }}">
                                        <button class="btn btn-primary btn-block">Tạo mới</button>
                                    </a>
                                </div>
                                <div class="col-xs-2">
                                    <!-- <button class="btn btn-primary btn-block">Import</button> -->
                                </div>
                                <div class="col-xs-1 no-padding">
                                </div>
                                <div class="col-lg-2 col-xs-1">
                                </div>
                                <div class="col-xs-1 no-padding">
                                </div>
                                <div class="col-lg-2 col-xs-1">
                                </div>
                                <form action="{{route('admin.mat_hang_kinh_doanh.export', $id_ho)}}" method="get">
                                    <input type="hidden" name="sap" value="{{isset($_GET['sap']) ? $_GET['sap'] : ''}}">
                                    <input type="hidden" name="sort" value="{{isset($_GET['sort']) ? $_GET['sort'] : ''}}">
                                    <input type="hidden" name="key" value="{{isset($_GET['key']) ? $_GET['key'] : ''}}">
                                    <div class="col-xs-2">
                                        <select class="form-control" name="type">
                                            <option value="excel">Excel</option>
                                            <option value="pdf">Pdf</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-1 col-xs-2 no-padding">
                                        <button class="btn btn-primary btn-block" type="submit">Export</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách các mặt hàng kinh doanh </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body custom-table">
                        <div class="table-responsive">
                            <table class="table table-hover" style="min-width: 1500px;">
                                <thead class="">
                                    <tr>
                                        <!-- <th><input type="checkbox"></th> -->
                                        <th style="width: 150px">Chức Năng</th>
                                        <th>STT</th>
                                        <th>Sạp</th>
                                        <th>Mặt hàng kinh doanh</th>
                                        <th style="width: 87px;">Tên cơ sở cung cấp</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Lượng hàng</th>
                                        <th>Đơn vị tính</th>
                                        <th>Giấy tờ chứng minh nguồn gốc</th>
                                        <th>Ngày đăng ký</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                @foreach($list as $index => $item)
                                <tbody>
                                    <!-- <td class="text-center"><input type="checkbox"></td> -->
                                    <td>
                                        <a href="{{ route('admin.mat_hang_kinh_doanh.edit', [$id_ho, $item->id]) }}" class="btn btn-success btn-xs">Sửa</a>
                                        <a onclick="return confirm('Bạn có muốn xóa không?') ;" href="{{ route('admin.mat_hang_kinh_doanh.delete', $item->id) }}" class="btn btn-danger btn-xs">Xóa</a>
                                        <!-- <a href="#" class="btn btn-primary btn-xs">Chi tiết</a> -->
                                    </td>
                                    <td>{{$index + 1}}</td>
                                    <td>{{isset($item->getSap) ? $item->getSap->ten : 'N/A'}}</td>
                                    <td>{{$item->ten}}</td>
                                    <td>{{$item->getCoSoCungCap->ten}}</td>
                                    <td>{{$item->getCoSoCungCap->dia_chi}}</td>
                                    <td>{{$item->getCoSoCungCap->sdt}}</td>
                                    <td>{{$item->luong_hang_bq_nhap}}</td>
                                    <td>{{isset($item->getDonViTinh->ten) ? $item->getDonViTinh->ten : 'N/A'}}</td>
                                    <td>
                                        @if($item->url_giay_chung_nhan!=null)
                                            <a href="{{url('upload/'.$item->url_giay_chung_nhan)}}">{{$item->ten_giay_chung_nhan}}</a>
                                        @else
                                            {{$item->ten_giay_chung_nhan}}
                                        @endif
                                    </td>
                                    <td>{{date("d/m/Y", strtotime($item->ngay_dang_ky)) }}</td>
                                    <td>{{$item->ghi_chu}}</td>
                                </tbody>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <!-- <th>#</th> -->
                                        <th style="width: 130px">Chức Năng</th>
                                        <th>STT</th>
                                        <th>Sạp</th>
                                        <th>Mặt hàng kinh doanh</th>
                                        <th style="width: 87px;">Tên cơ sở cung cấp</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Lượng hàng</th>
                                        <th>Đơn vị tính</th>
                                        <th>Giấy tờ chứng minh nguồn gốc</th>
                                        <th>Ngày đăng ký</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                    <!-- <tr>
                                        <th>Số GCN</th>
                                        <th>Thời gian
                                            hiệu lực</th>
                                    </tr> -->
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
