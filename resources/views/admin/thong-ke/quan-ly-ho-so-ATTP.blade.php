@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Hồ sơ quản lí ATTP
               <!--  <small>
                    <a href="{{route("admin.ho_kinh_doanh.add")}}">
                        <button class="btn btn-primary">Tạo mới</button>
                    </a>
                </small>
                <small>
                    <button class="btn btn-primary">Import</button>
                </small> -->
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content table-border">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-solid box-primary">
                        <!-- .box-header -->
                        <div class="box-header">
                            <h3 class="box-title">Bộ lọc </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- .box-body -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">

                                    <form action="{{route("admin.quanly.hoso.attp")}}" method="get">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="hidden" name="cho" value="{{old('cho')}}">
                                                <input name="key" class="form-control"
                                                       value="{{old('key')}}"
                                                       placeholder="Từ Khóa">
                                            </div>
                                            <div class="col-xs-4">
                                                <select class=" form-control" name="type">
                                                    <option value="2" {{old('type') == 2 ? 'selected' : ''}}>Mã số hộ</option>
                                                     <option value="1"  {{old('type') == 1 ? 'selected' : ''}}>Tên họ kinh doanh</option>


                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-xs-2 text-center">
                                                <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-xs-2">
                                           
                                        </div>
                                        
                                        <form action="{{route("admin.quanly.hoso.attp")}}">
                                                
                                            <div class="col-xs-5 text-right custom-select-excel">
                                            
                                            <select class="form-control select-excel cho" name="cho">
                                                 <option value="">Tất cả các chợ</option>
                                                @forelse($cho as $item)

                                                <option value="{{$item->id}}" {{$item->id == old('cho') ? 'selected' : ''}}>{{$item->ten}}</option>
                                                @empty
                                                <option >Chưa có chợ</option>
                                                @endforelse
                                                
                                            </select>
                                        </div>
                                        {{--<div class="col-xs-3 text-right custom-select-excel">--}}
                                            {{--<select class="form-control select-excel" name="nganh">--}}
                                                {{--@forelse($mathang as $hang)--}}
                                                {{--<option value="">Tất cả sản phẩm</option>--}}
                                                {{--<option value="{{$hang->id}}">{{$hang->ten_nganh}}</option>--}}
                                                {{--@empty--}}
                                                {{--<option >Chưa có ngành</option>--}}
                                                {{--@endforelse--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                         <div class="col-xs-3 text-right custom-select-excel" >
                                             <select class="form-control select-excel" name="sort">
                                                <option value="asc">Tăng Dần</option>
                                                <option value="desc" >Giảm Dần</option>
                                            </select>

                                        </div>
                                        <div class="col-xs-2 text-right">
                                            <button class="btn btn-primary" style="width: 73px">Lọc</button>
                                        </div>
                                                
                                            
                                         </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-10">
                                <div class="col-xs-8">
                                    <div class="row">
                                        {{--<div class="col-xs-4">--}}
                                           {{--<button class="form-control btn btn-primary">Import</button>--}}
                                        {{--</div>--}}
                                         <!-- <div class="col-xs-4">
                                            <button class="btn btn-primary" style="width: 73px">Export</button>
                                        </div> -->


                                    </div>
                                </div>
                                <!-- excel export -->
                                <div class="col-xs-4">
                                    <div class="row">
                                        <div class="form-group col-xs-6 text-left">
                                            <button class="btn btn-danger btn-small form-control" id="export">Export</button>
                                        </div>
                                         <div class="form-group col-xs-6 text-left">
                                            <a href="{{route("admin.quanly.hoso.attp")}}" class="btn btn-primary form-control">Làm mới</a>
                                                
                                            </div>
                                            
                                    </div>
                                </div>
                                <!-- /.excel export -->
                                <!-- /.box-body -->
                               
                            </div>

                        </div>
                    </div>
                    @if(Session::has('error'))
                        <div class="alert alert-error">
                            <b style="text-align: center">{!! Session::get('error') !!}</b>
                        </div>
                    @endif
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách hồ sơ</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body custom-table">
                            <div class="table-responsive">
                                <table class="table table-hover" style="min-width: 1500px;">
                                    <thead class="">
                                    <tr>
                                         <th rowspan="2">STT</th>
                                        <th rowspan="2">Họ tên chủ hộ KD</th>
                                        <th rowspan="2">Mã quầy/sạp</th>
                                        <th rowspan="2">GCN ĐKKD</th>
                                        <th rowspan="2">GCN đủ điều kiện ATTP</th>
                                        <th rowspan="2">Bản cam kết</th>
                                        <th rowspan="2">Khám sức khỏe</th>
                                        <th rowspan="2">Giấy xác nhận kiến thức ATTP</th>
                                        <th rowspan="2">Số Lao động</th>
                                        <th rowspan="2">Ghi chú</th>
                                    </tr>
                                    <!-- <tr>
                                        <th>Số GCN</th>
                                        <th>Thời gian
                                            hiệu lực</th>
                                    </tr> -->
                                    </thead>
                                    <tbody>

                                    @forelse($list as $index => $item)
                                        <tr>
                                            <td>{{$index}}</td>
                                            <td>{{$item->ten_ho_kd}}</td>
                                            <td>{{$item->getSap->first()['ma_so_sap']}}</td>
                                            <td>{{$item->ma_so_ho_kd}}</td>
                                            <td>{{$item->GCN_du_dieu_kien == 1 ? 'Có' : 'Không có'}} </td>
                                            <td>{{$item->ban_cam_ket_dam_bao == 1 ? 'Có' : 'Không có'}}</td>
                                            <td>{{$item->kham_suc_khoe == 1 ? 'Có' : 'Không có'}}</td>
                                            <td>{{$item->giay_xac_nhan_kie_thuc == 1 ? 'Có' : 'Không có'}}</td>
                                            <td>{{$item->so_lao_dong}}</td>
                                            <td>{{$item->ghi_chu}}</td>
                                        </tr>
                                        @empty
                                    @endforelse
                                    </tbody>
                                    <thead>
                                         <tr>
                                             <th rowspan="2">STT</th>
                                             <th rowspan="2">Họ tên chủ hộ KD</th>
                                             <th rowspan="2">Mã quầy/sạp</th>
                                             <th rowspan="2">GCN ĐKKD</th>
                                             <th rowspan="2">GCN đủ điều kiện ATTP</th>
                                             <th rowspan="2">Bản cam kết</th>
                                             <th rowspan="2">Khám sức khỏe</th>
                                             <th rowspan="2">Giấy xác nhận kiến thức ATTP</th>
                                             <th rowspan="2">Số Lao động</th>
                                             <th rowspan="2">Ghi chú</th>
                                    </tr>
                                    </thead>
                                   

                                </table>

                            </div>
                            <div class="row">
                            <div class="col-xs-2 text-left record-show">
                                <form action="{{route('admin.quanly.hoso.attp')}}" method="get">
                                     <select id="mySelect" class="form-control select" name="paginate" onchange="this.form.submit()">

                                     <option value="10" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 10 ? 'selected' : '' }}>10 kết quả</option>
                                    <option value="20" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 20 ? 'selected' : '' }}>20 kết quả</option>
                                    <option value="30" {{ isset($_GET['paginate'])&& $_GET['paginate'] == 30 ? 'selected' : '' }}>30 kết quả</option>
                                    <option value="-1" {{ isset($_GET['paginate'])&& $_GET['paginate'] == -1 ? 'selected' : '' }}>Tất cả kết quả</option>
                                </select>
                                </form>
                                
                            
                            </div> 
                            <div class="col-xs-10 paginate text-right">
                                @if($list != null)
                                 {{$list->links()}}
                                    @endif
                            </div>
                        </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
        <script type="text/javascript">

         $(document).ready(function(){

                 setTimeout(function (){$('.alert-error').slideUp("slow");},2500);


            $("#export").click(function(event) {
               var cho = $('.cho').val();
                location.href = "{{route('admin.quanly.hoso.attp.export')}}"+'?action=export&cho='+cho
               // $.ajax({
               //     url: '{{route('admin.quanly.hoso.attp.export')}}',
               //     type: 'post',
               //     data: {cho: cho,
               //      action:'export',
               //      '_token':'{{csrf_token()}}'},
               //      data0-type
               //      success:function(data){
               //         if(!('error' in data))
               //         {
               //          alert(data[1]);
               //         }
               //      }
               // })
               
               
            });
         });
        </script>
@endsection