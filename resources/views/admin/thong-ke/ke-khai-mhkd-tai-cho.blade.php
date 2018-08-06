@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kê khai mặt hàng kinh doanh
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Kê khai mặt hàng kinh doanh</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content table-border">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Chức năng </h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <form action="{{route('admin.thongke.mhkd.list')}}">
                                                        <!-- <div class="col-md-4">

                                                        <select class="form-control" name="cho">
                                                            @forelse($listCho as $cho)
                                                            <option value="{{$cho->id}}">{{$cho->ten}}</option>
                                                            @empty
                                                            <option>Không có chợ</option>
                                                            @endforelse

                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="nganh">
@forelse($listNganh as $nganh)

                                                            <option value="{{$nganh->id}}">{{$nganh->ten_nganh}}</option>
                                                            @empty
                                                            <option>Không có ngành</option>
                                                            @endforelse

                                                                </select>
                                                            </div> -->

                                                            <div class="col-md-4">

                                                                <input type="text" class="form-control date"
                                                                       id="input_date"
                                                                       placeholder="Từ ngày.. | đến ngày.." name="day"
                                                                       value="{{old('day')}}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="submit" class="form-control btn btn-info">
                                                                    Lọc
                                                                </button>
                                                            </div>
                                                            <div class="col-md-3">

                                                                <select class="form-control" id="export_type"
                                                                        name="export">
                                                                    <option value="excel">Excel</option>
                                                                    <option value="pdf">PDF</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a class="form-control btn btn-primary" id="export">Export</a>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!--  <div class="row">
                                                         <div class="col-md-6">
                                                             <input type="text" class="form-control date" id="input_date" placeholder="Từ ngày.. - đến ngày.." name="">
                                                         </div>
                                                         <div class="col-md-6">
                                                             <a class="form-control btn btn-primary" href="">Export</a>
                                                         </div>
                                                     </div> -->
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row pull-right">

                                                        <div class="col-md-6">
                                                            <!-- <button class="form-control btn btn-danger">Làm mới</button> -->
                                                            <a href="{{route('admin.thongke.mhkd.list')}}"
                                                               class="btn btn-danger">Làm mới</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Kê khai mặt hàng kinh doanh tại các chợ</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body custom-table">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="min-width: 1500px;">
                                            <thead>
                                            <tr>

                                                <th rowspan="1">Nội dung</th>
                                                @if(isset($getListCho) && $getListCho != null)
                                                    @foreach($getListCho as $cho)
                                                        <th>{{$cho->ten}}</th>
                                                    @endforeach
                                                @endif


                                            </tr>

                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td style="font-weight: bold;">Số hộ kinh doanh thực phẩm</td>
                                                @if(isset($listSoHoKinhDoanh) && $listSoHoKinhDoanh != null)
                                                    @forelse($listSoHoKinhDoanh as $ho)
                                                        <td class="text-center">{{$ho['tong']}}</td>
                                                    @empty
                                                    @endforelse
                                                @endif
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold;">Số hộ thực hiện kê khai:</td>
                                                @if(isset($getSoHoKeKhai) && $getSoHoKeKhai != null)
                                                    @forelse($getSoHoKeKhai as $kekhai)
                                                        @if(isset($kekhai['tongsokekhai']))
                                                            <td class="text-center">{{$kekhai['tongsokekhai']}}</td>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                @endif

                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold;">Chiếm tỷ lệ (%):</td>
                                                @if(isset($getSoHoKeKhai) && $getSoHoKeKhai != null)
                                                    @forelse($getSoHoKeKhai as $kekhai)
                                                        <td class="text-center">{{round($kekhai['tiso'],2)}} %</td>
                                                    @empty
                                                    @endforelse
                                                @endif

                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold;">Trong đó</td>

                                            </tr>
                                            @if(isset($getListCho) && $getListCho )
                                                @forelse($getListCho as $key => $cho)
                                                    @if($key == 0)
                                                        @forelse($getListNganh as $nganh)


                                                            <tr>
                                                                <td style="width: 250px;">{{$nganh->ten_nganh}}</td>

                                                                @forelse($getListKeKhai as $KeKhai)
                                                                    @forelse($KeKhai as $data)
                                                                        @if($data['nganh'] == $nganh->id)
                                                                            <td class="text-center">{{$data['soluong']}}</td>
                                                                        @endif
                                                                    @empty
                                                                    @endforelse
                                                                @empty
                                                                @endforelse

                                                            </tr>
                                                        @empty
                                                        @endforelse
                                                    @endif
                                                @empty
                                                @endforelse
                                            @endif


                                            <tr>
                                                <td style="font-weight: bold;">Về GCN ATTP</td>

                                            </tr>
                                            <tr>
                                                <td>Số hộ đã cấp GCN ATTP:</td>
                                                @if(isset($getGiayPhepATTP) && $getGiayPhepATTP != null)
                                                    @forelse($getGiayPhepATTP as $ATTP)
                                                        <td class="text-center">{{$ATTP['dalam']}}</td>
                                                    @empty
                                                    @endforelse
                                                @endif

                                            </tr>
                                            <tr>
                                                <td>Số hộ đang làm GCN ATTP:</td>
                                                @if(isset($getGiayPhepATTP) && $getGiayPhepATTP != null)
                                                    @forelse($getGiayPhepATTP as $ATTP)

                                                        <td class="text-center">{{$ATTP['danglam']}}</td>
                                                    @empty
                                                    @endforelse
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Số hộ chưa làm GCN ATTP:</td>
                                                @if(isset($getGiayPhepATTP) && $getGiayPhepATTP != null)
                                                    @forelse($getGiayPhepATTP as $ATTP)

                                                        <td class="text-center">{{$ATTP['chualam']}}</td>
                                                    @empty
                                                    @endforelse
                                                @endif
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script>
        $(function () {
            $("#input_date").focus(function () {

                $(this).daterangepicker(
                    {
                        locale: {
                            format: 'YYYY-MM-DD',
                            "separator": " | ",
                        },
                        ranges: {
                            'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                            'Quí trước': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                            'Năm trước': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate: moment()
                    },
                );
            });

            $("#export").click(function (e) {
                var day = $('#input_date').val();
                var type = $('#export_type').val();
                if (type === 'excel') {
                    location.href = '{{route('admin.thongke.mhkd.export')}}/?day=' + day
                }
                else if (type === 'pdf') {
                    location.href = '{{route('admin.thongke.mhkd.exportpdf')}}/?day=' + day
                }
                else {
                    location.href = '{{route('admin.thongke.mhkd.export')}}'
                }

            });

        })
    </script>
@endsection
