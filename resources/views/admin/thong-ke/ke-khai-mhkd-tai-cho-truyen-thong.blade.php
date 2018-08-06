@extends('admin.master')
@section('content')
    <style>
        .no-padding {
            padding: 0px;
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
                <li class="active">Bảng kê khai các mặt hàng kinh doanh tại chợ truyền thống</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content table-border">
            <form action="{{route('admin.thong_ke.ke-khai-mhkd-tai-cho-truyen-thong')}}" method="get">
                <div class="row">
                    <div class="col-xs-12">
                        {{message()}}
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Thông tin sạp </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <select id="list_cho" class="form-control" name="id_cho">
                                                    <option value="" selected>---Chợ---</option>
                                                    @foreach($data_cho as $item)
                                                        <option value="{{ $item->id }}" {{ isset($_GET['id_cho'])&& $_GET['id_cho'] == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xs-3">
                                                <select class="list_sap col-xs-6 form-control"
                                                        id="list_sap" name="id_sap">
                                                    @foreach($data_sap as $item)
                                                        <option value="{{ $item->id }}" {{ isset($_GET['id_sap'])&& $_GET['id_sap'] == $item->id ? 'selected' : '' }} >{{ $item->ten }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xs-3">
                                                <input name="value" class="form-control"
                                                       value="{{ isset($_GET['value']) ? $_GET['value'] : ''}}"
                                                       placeholder="Từ Khóa">
                                            </div>
                                            <div class="col-xs-3 text-center">
                                                <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <select class="form-control" name="type" id="export_type">
                                            <option value="excel">Excel</option>
                                            <option value="pdf">Pdf</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-1 col-xs-2 no-padding">
                                        <button class="btn btn-primary btn-block" type="button" id="export"
                                                style="width:73px">Export
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-solid box-primary">
                            <!-- .box-header -->
                            @php
                                $ten_sap = '';
                                $ten_cho = '';
                                $tang = '';
                                $ten_ho_kd = '';
                                $sdt_ho_kd = '';
                                $ma_so_ho_kd = '';
                                $ma_so_giay_ATTP = '';
                                $noi_cap_giay_ATTP = '';
                                $ngay_thay_doi = '';
                                $ngay_cap_giay_ATTP = '';
                                $kham_suc_khoe = '';
                                $giay_xac_nhan_kien_thuc = '';
                                $thoi_gian_hieu_luc_ATTP = '';
                                $GCN_du_dieu_kien = '';
                                $ban_cam_ket_dam_bao = '';
                                $ten_nganh = '';
                            @endphp
                            @if(isset($data_search) ? $data_search : "")
                                @php
                                    $ten_sap = (isset($data_search['data_sap']->ten)) ? $data_search['data_sap']->ten : "-";
                                    $id_sap = (isset($data_search['data_sap']->id)) ? $data_search['data_sap']->id : "-";
                                    $ten_cho = (isset($data_search['data_cho']->ten)) ? $data_search['data_cho']->ten : "-";
                                    $tang = (isset($data_search['data_ho_kinh_doanh']->tang)) ? $data_search['data_ho_kinh_doanh']->tang : "-";
                                    $ten_ho_kd = (isset($data_search['data_ho_kinh_doanh']->ten_ho_kd)) ? $data_search['data_ho_kinh_doanh']->ten_ho_kd : "-";
                                    $sdt_ho_kd = (isset($data_search['data_ho_kinh_doanh']->sdt_ho_kd)) ? $data_search['data_ho_kinh_doanh']->sdt_ho_kd : "-";
                                    $ma_so_ho_kd = (isset($data_search['data_ho_kinh_doanh']->ma_so_ho_kd)) ? $data_search['data_ho_kinh_doanh']->ma_so_ho_kd : "-";
                                    $ma_so_giay_ATTP = (isset($data_search['data_ho_kinh_doanh']->ma_so_giay_ATTP)) ? $data_search['data_ho_kinh_doanh']->ma_so_giay_ATTP : "-";
                                    $noi_cap_giay_ATTP = (isset($data_search['data_ho_kinh_doanh']->noi_cap_giay_ATTP)) ? $data_search['data_ho_kinh_doanh']->noi_cap_giay_ATTP : "-";
                                    $ngay_thay_doi = (isset($data_search['data_ho_kinh_doanh']->ngay_thay_doi)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_search['data_ho_kinh_doanh']->ngay_thay_doi)->format('d-m-Y') : "-";
                                    $ngay_cap_giay_ATTP = (isset($data_search['data_ho_kinh_doanh']->ngay_cap_giay_ATTP)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_search['data_ho_kinh_doanh']->ngay_cap_giay_ATTP)->format('d-m-Y') : "-";
                                    $kham_suc_khoe = (isset($data_search['data_ho_kinh_doanh']->kham_suc_khoe)) ? $data_search['data_ho_kinh_doanh']->kham_suc_khoe : "-";
                                    $giay_xac_nhan_kien_thuc = (isset($data_search['data_ho_kinh_doanh']->giay_xac_nhan_kien_thuc)) ? $data_search['data_ho_kinh_doanh']->giay_xac_nhan_kien_thuc : "-";
                                    $thoi_gian_hieu_luc_ATTP = (isset($data_search['data_ho_kinh_doanh']->thoi_gian_hieu_luc_ATTP)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_search['data_ho_kinh_doanh']->thoi_gian_hieu_luc_ATTP)->format('d-m-Y') : "-";
                                    $GCN_du_dieu_kien = (isset($data_search['data_ho_kinh_doanh']->GCN_du_dieu_kien)) ? $data_search['data_ho_kinh_doanh']->GCN_du_dieu_kien : "-";
                                    $ban_cam_ket_dam_bao = (isset($data_search['data_ho_kinh_doanh']->ban_cam_ket_dam_bao)) ? $data_search['data_ho_kinh_doanh']->ban_cam_ket_dam_bao : "-";
                                    $ten_nganh = (isset($data_search['data_nganh_kinh_doanh']->ten_nganh)) ? $data_search['data_nganh_kinh_doanh']->ten_nganh : "-";
                                @endphp
                            @endif

                            @if(isset($data_filter) ? $data_filter : "")

                                @php
                                    $ten_cho = (isset($data_filter['data_cho']->ten)) ? $data_filter['data_cho']->ten : "-";
                                    //dd($ten_cho);
                                    $tang = (isset($data_filter['data_ho_kinh_doanh']->tang)) ? $data_filter['data_ho_kinh_doanh']->tang : "-";
                                    $ten_ho_kd = (isset($data_filter['data_ho_kinh_doanh']->ten_ho_kd)) ? $data_filter['data_ho_kinh_doanh']->ten_ho_kd : "-";
                                    $sdt_ho_kd = (isset($data_filter['data_ho_kinh_doanh']->sdt_ho_kd)) ? $data_filter['data_ho_kinh_doanh']->sdt_ho_kd : "-";
                                    $ma_so_ho_kd = (isset($data_filter['data_ho_kinh_doanh']->ma_so_ho_kd)) ? $data_filter['data_ho_kinh_doanh']->ma_so_ho_kd : "-";
                                    $ma_so_giay_ATTP = (isset($data_filter['data_ho_kinh_doanh']->ma_so_giay_ATTP)) ? $data_filter['data_ho_kinh_doanh']->ma_so_giay_ATTP : "-";
                                    $noi_cap_giay_ATTP = (isset($data_filter['data_ho_kinh_doanh']->noi_cap_giay_ATTP)) ? $data_filter['data_ho_kinh_doanh']->noi_cap_giay_ATTP : "-";
                                    $ngay_thay_doi = (isset($data_filter['data_ho_kinh_doanh']->ngay_thay_doi)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_filter['data_ho_kinh_doanh']->ngay_thay_doi)->format('d-m-Y') : "-";
                                    $ngay_cap_giay_ATTP = (isset($data_filter['data_ho_kinh_doanh']->ngay_cap_giay_ATTP)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_filter['data_ho_kinh_doanh']->ngay_cap_giay_ATTP)->format('d-m-Y') : "-";
                                    $kham_suc_khoe = (isset($data_filter['data_ho_kinh_doanh']->kham_suc_khoe)) ? $data_filter['data_ho_kinh_doanh']->kham_suc_khoe : "-";
                                    $giay_xac_nhan_kien_thuc = (isset($data_filter['data_ho_kinh_doanh']->giay_xac_nhan_kien_thuc)) ? $data_filter['data_ho_kinh_doanh']->giay_xac_nhan_kien_thuc : "-";
                                    $thoi_gian_hieu_luc_ATTP = (isset($data_filter['data_ho_kinh_doanh']->thoi_gian_hieu_luc_ATTP)) ? \Carbon\Carbon::createFromFormat('Y-m-d',$data_filter['data_ho_kinh_doanh']->thoi_gian_hieu_luc_ATTP)->format('d-m-Y') : "-";
                                    $GCN_du_dieu_kien = (isset($data_filter['data_ho_kinh_doanh']->GCN_du_dieu_kien)) ? $data_filter['data_ho_kinh_doanh']->GCN_du_dieu_kien : "-";
                                    $ban_cam_ket_dam_bao = (isset($data_filter['data_ho_kinh_doanh']->ban_cam_ket_dam_bao)) ? $data_filter['data_ho_kinh_doanh']->ban_cam_ket_dam_bao : "-";
                                    $ten_nganh = (isset($data_filter['data_nganh_kinh_doanh']->ten_nganh)) ? $data_filter['data_nganh_kinh_doanh']->ten_nganh : "-";
                                @endphp
                            @endif

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
                                            <input class="form-control"
                                                   value="{{isset($_GET['id_sap']) ? $ten_cho : "" || isset($_GET['value']) ? $ten_cho : ''}}"
                                                   readonly>
                                        </div>

                                        <div class="col-xs-1 no-padding">
                                            <label>Số quầy KD</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class=" row form-control select2" disabled name="sap[]"
                                                    multiple="multiple">
                                                @if(isset($data_filter['data_sap']))
                                                    @if($data_filter['data_sap'])

                                                        @php $sap = $data_filter['data_sap']; $sap_array = array_pluck($sap->ToArray(),['id']);@endphp
                                                        @foreach($sap as $item)
                                                            <option {{ in_array($item->id,$sap_array) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->ten }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                                @if (isset($data_search['data_sap']))
                                                    <option value="{{$id_sap}}" selected>{{$ten_sap}}</option>
                                                @elseif (!isset($data_search['data_sap']) )
                                                    @php $data_search['data_sap'] = "" @endphp
                                                @else
                                                    @php $data_filter['data_sap'] = "" @endphp
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-xs-1 no-padding">
                                            <label>Tầng</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control"
                                                   value="{{  $tang }}" readonly>
                                        </div>


                                        <div class="col-xs-1 no-padding">
                                            <label>Tên chủ hộ</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control"
                                                   value="{{  $ten_ho_kd}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 mt-10">
                                        <div class="col-xs-1 no-padding">
                                            <label>Số điện thoại</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control"
                                                   value="{{ $sdt_ho_kd}}" readonly>
                                        </div>

                                        <div class="col-xs-1 no-padding">
                                            <label>Ngành nghề KD chính</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control"
                                                   value="{{ $ten_nganh}}" readonly>
                                        </div>

                                        <div class="col-xs-1 no-padding">
                                            <label>Số GCN ĐKKD</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control" readonly
                                                   value="{{ $ma_so_ho_kd}}">
                                        </div>
                                        <div class="col-xs-1 no-padding">
                                            <label>Ngày cấp GCNDKKD</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control" readonly
                                                   value="{{  $ngay_thay_doi}}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 mt-10">
                                        <div class="col-xs-1 no-padding">
                                            <label>Số giấy tờ ATTP</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control"
                                                   value="{{ $ma_so_giay_ATTP }}" readonly>
                                        </div>

                                        <div class="col-xs-1 no-padding">
                                            <label>Nơi cấp</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control"
                                                   value="{{$noi_cap_giay_ATTP}}"
                                                   readonly>
                                        </div>
                                        <div class="col-xs-1 no-padding">
                                            <label>Ngày cấp giấy ATTP</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control"
                                                   value="{{ $ngay_cap_giay_ATTP}}"
                                                   readonly>
                                        </div>

                                        <div class="col-xs-1 no-padding">
                                            <label>Thời gian hiệu lực</label>
                                        </div>
                                        <div class="col-xs-2">
                                            <input class="form-control"
                                                   value="{{$thoi_gian_hieu_luc_ATTP}}"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 mt-10">
                                        <div class="col-xs-3 ">
                                            <div class=" form-control border-none checkbox1">
                                                <label class="col-xs-8">Khám Sức Khỏe</label>
                                                <div class="col-xs-4">
                                                    <input type="checkbox" name="kham_suc_khoe"
                                                           value="1"
                                                           <?php if (isset($_GET['value']) || isset($_GET['id_sap'])) {
                                                               if ($kham_suc_khoe == 1) {
                                                                   echo "checked";
                                                               }
                                                           }
                                                           ?>
                                                           class="checkbox" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="row  form-control border-none">
                                                <label class="col-xs-8">Giấy xác nhận kiến thức</label>
                                                <div class="col-xs-4">
                                                    <input type="checkbox" name="giay_xac_nhan_kien_thuc"
                                                           value="1"
                                                           <?php if (isset($_GET['value']) || isset($_GET['id_sap'])) {
                                                               if ($giay_xac_nhan_kien_thuc == 1) {
                                                                   echo "checked";
                                                               }
                                                           }
                                                           ?>
                                                           class="checkbox" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="row  form-control border-none">
                                                <div class="checkbox">
                                                    <label class="col-xs-8">GCN đủ điều kiện</label>
                                                    <div class="col-xs-4">
                                                        <input type="checkbox" name="GCN_du_dieu_kien"
                                                               value="1"
                                                               <?php if (isset($_GET['value']) || isset($_GET['id_sap'])) {
                                                                   if ($GCN_du_dieu_kien == 1) {
                                                                       echo "checked";
                                                                   }
                                                               }
                                                               ?> disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="row  form-control border-none">
                                                <label class="col-xs-8">Bản cam kết đảm bảo ATTP</label>
                                                <div>
                                                    <input type="checkbox" name="ban_cam_ket_dam_bao"
                                                           value=""
                                                           <?php if (isset($_GET['value']) || isset($_GET['id_sap'])) {
                                                               if ($ban_cam_ket_dam_bao == 1) {
                                                                   echo "checked";
                                                               }
                                                           }
                                                           ?>
                                                           class="checkbox" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-10">
                                    <div class="col-xs-12">

                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title ">Danh sách các mặt hàng kinh doanh </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body custom-table">
                                <div class="table-responsive">
                                    <table class="table table-hover" style="min-width: 1500px;">
                                        <thead class="">
                                        <tr>
                                            <th>STT</th>
                                            <th>Sạp</th>
                                            <th>Mặt hàng kinh doanh</th>
                                            <th style="width: 87px;">Tên cơ sở cung cấp</th>
                                            <th>Địa chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th>Lượng hàng</th>
                                            <th>Đơn vị tính</th>
                                            <th>Giấy tờ chứng minh nguồn gốc</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                        <?php //dd($list)?>
                                        </thead>
                                        @if((!isset($_GET['id_sap'])) && (!isset($_GET['value'])))
                                            @php $list = [] @endphp
                                            <tbody>
                                            <tr>
                                            </tr>
                                            </tbody>
                                        @endif
                                        @if((isset($_GET['id_sap']) && $_GET['id_sap'] == "") && (isset($_GET['value']) && $_GET['value'] == ""))
                                            <tbody>
                                            <tr>
                                            </tr>
                                            </tbody>
                                        @else
                                            <tbody>
                                            @foreach($list as $item)

                                                @if(!isset($item['search']))
                                                    @php
                                                        $id_co_so = $item->id_co_so_cc;
                                                        $id_ho_kd = $item->listHoKinhDoanh;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$start_order++}}</td>
                                                        <td>{{$item->ma_sap}}</td>
                                                        <td>{{$item->ten}}</td>
                                                        <td>{{$id_co_so->ten}}</td>
                                                        <td>{{$id_co_so->dia_chi}}</td>
                                                        <td>{{$id_co_so->sdt}}</td>
                                                        <td>{{$item->luong_hang_bq_nhap}}</td>
                                                        <td>{{$item->dv_tinh}}</td>
                                                        <td>{{$item->ten_giay_chung_nhan}}</td>
                                                        <td>{{$item->ghi_chu}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>


                                        @endif


                                        <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Sạp</th>
                                            <th>Mặt hàng kinh doanh</th>
                                            <th style="width: 87px;">Tên cơ sở cung cấp</th>
                                            <th>Địa chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th>Lượng hàng</th>
                                            <th>Đơn vị tính</th>
                                            <th>Giấy tờ chứng minh nguồn gốc</th>
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
                                <div class="row">
                                    <div class="col-xs-2 text-left record-show">
                                        <select id="mySelect" class="form-control select" name="paginate"
                                                onchange="this.form.submit()">
                                            <option value="10" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 10 ? 'selected' : '' }}>
                                                10 kết quả
                                            </option>
                                            <option value="20" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 20 ? 'selected' : '' }}>
                                                20 kết quả
                                            </option>
                                            <option value="30" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 30 ? 'selected' : '' }}>
                                                30 kết quả
                                            </option>
                                        </select>
                                        <p id="demo"></p>
                                    </div>
                                    <div class="col-xs-10 paginate text-right">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
@section('footer')
    <script>
        //getListSap
        $(document).ready(function () {
            function getListSap(id_cho, class_input) {
                $.get('{{ url('admin/ajax/ke-khai-mhkd-tai-cho-truyen-thong/sap?id_cho=') }}' + id_cho, function (res) {
                    if (res.code == 200) {

                        var html3 = '  <option value="">----Sạp---</option>';

                        var data = res.data;
                        for (var i = 0; i < data.length; i++) {
                            html3 += '<option value="' + data[i]['id'] + '"> ' + data[i]['ten_sap'] + '</option>';
                        }
                        $(class_input).html(html3);
                    }
                });
            }

            $('#list_cho').change(function () {
                var id = $(this).val();
                console.log(id);
                getListSap(id, '#list_sap');
            });
            $("#export").click(function (e) {
                var sap = "{{(isset($_GET['id_sap']) ? $_GET['id_sap'] : "")}}";
                var hkd = "{{(isset($_GET['value']) ? $_GET['value'] : "")}}";
                var type = $('#export_type').val();
                if (type === 'excel') {
                    location.href = '{{route('admin.thong_ke.ke-khai-mhkd-tai-cho-truyen-thong.export')}}/?id_sap=' + sap + '&value=' + hkd;
                }
                else if (type === 'pdf') {
                    location.href = '{{route('admin.thong_ke.ke-khai-mhkd-tai-cho-truyen-thong.exportPDF')}}/?id_sap=' + sap + '&value=' + hkd;
                }
            });

        });


    </script>
@endsection
