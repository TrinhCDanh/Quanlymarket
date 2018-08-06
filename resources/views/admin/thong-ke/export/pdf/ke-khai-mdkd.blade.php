                                   <html> 
                                   <head>
                                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                                        <style>
                                        table {
                                    border-collapse: collapse;
                                        }
                                            body {
                                                        font-family: DejaVu Sans;
                                                        
                                                }
                                                table{
                                                     width: 100%;
                                                }
                                                table, th, td {
                                                border: 1px solid black;
                                                }
                                                th{
                                                    text-align: center;
                                                    padding: 5px 10px 5px 5px;
                                                    text-transform: uppercase;

                                                }
                                                .tdpadding{
                                                    padding: 1px 10px 1px 5px;
                                                    text-align: left;
                                                }
                                                .td-default{
                                                    text-align: center;

                                                }
                                                h1{
                                                    font-size: 20px;
                                                    text-transform: uppercase;
                                                }
                                                td,th{
                                                    font-size: 14px;
                                                }
                                                .left{
                                                    width: 500px;
                                                    float: left;
                                                    text-align: center;
                                                }
                                                .right{
                                                    width: 500px;
                                                    float: right;
                                                    text-align: center;
                                                }
                                                .clearfix::after {
                                                content: "";
                                                clear: both;
                                                display: table;
                                                    }
                                        </style>
                                   </head>
                                  <div class="left">
                                      <h1>ỦY BAN NHÂN DÂN QUẬN 5</h1>
                                       <h1 style="text-decoration: underline;">PHÒNG KINH TẾ</h1>
                                  </div>
                                   <div class="right">
                                      <h1>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h1>
                                       <h1 style="text-decoration: underline;">ĐỘC LẬP - TỰ DO - HẠNH PHÚC</h1>
                                  </div>
                                  <div class="clearfix"></div>
                                    <h1 style="text-align: center;">Thống kê thông tin dân cư trên địa bàn</h1>
                                    <table>
                                        <thead>
                                            <tr>
                                               
                                                <th >NỘI DUNG BÁO CÁO</th>
                                                
                                                @forelse($getListCho as $cho)

                                                <th>{{$cho->ten}}</th>
                                                @empty
                                            @endforelse


                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td   class="tdpadding">1. Số hộ kinh doanh thực phẩm</td>
                                                @forelse($listSoHoKinhDoanh as $ho)
                                                <td class="td-default" >{{$ho['tong']}}</td>
                                                @empty 
                                                @endforelse
                                            </tr>
                                              <tr>
                                                <td   class="tdpadding">2. Số hộ thực hiện kê khai:</td>
                                                 @forelse($getSoHoKeKhai as $kekhai)
                                                <td class="td-default" >{{$kekhai['tongsokekhai']}}</td>
                                                @empty 
                                                @endforelse
                                               
                                            </tr>
                                             <tr>
                                                <td   class="tdpadding" style="text-align: center;">Chiếm tỷ lệ (%):</td>
                                                @forelse($getSoHoKeKhai as $kekhai)
                                                <td class="td-default" >{{round($kekhai['tiso'],2)}} %</td>
                                                @empty 
                                                @endforelse

                                            </tr>
                                            <tr>
                                                <td  class="tdpadding">Trong đó: </td>
                                                    @forelse($getListCho as $key => $cho)
                                                    <td></td>
                                                    @empty
                                                    @endforelse
                                            </tr>
                                            @forelse($getListCho as $key => $cho) 
                                            @if($key == 0) 
                                            @forelse($getListNganh as $nganh)


                                            <tr>
                                                <td   class="tdpadding">{{$nganh->ten_nganh}}</td>

                                                @forelse($getListKeKhai as $KeKhai) @forelse($KeKhai as $data) @if($data['nganh'] == $nganh->id)
                                                <td class="td-default" >{{$data['soluong']}}</td>
                                                @endif @empty @endforelse @empty @endforelse

                                            </tr>
                                            @empty 
                                            @endforelse 
                                            @endif 
                                            @empty 
                                            @endforelse


                                            <tr>
                                                <td   class="tdpadding">3. Về GCN ATTP</td>
                                                @forelse($getListCho as $key => $cho)
                                                    <td></td>
                                                    @empty
                                                    @endforelse
                                            </tr>
                                             <tr>
                                                <td  class="tdpadding">Trong đó: </td>
                                                    @forelse($getListCho as $key => $cho)
                                                    <td></td>
                                                    @empty
                                                    @endforelse
                                            </tr>
                                            <tr>
                                                <td  class="tdpadding">Số hộ đã cấp GCN ATTP: </td>
                                                @forelse($getGiayPhepATTP as $ATTP)

                                                    <td class="td-default" >{{$ATTP['dalam']}}</td>
                                                @empty
                                                @endforelse
                                                
                                            </tr>
                                            <tr>
                                                <td  class="tdpadding">Số hộ đang làm GCN ATTP:</td>
                                             
                                                @forelse($getGiayPhepATTP as $ATTP)

                                                    <td class="td-default" >{{$ATTP['danglam']}}</td>
                                                @empty
                                                @endforelse
                                            </tr>
                                            <tr>
                                                <td  class="tdpadding">Số hộ chưa làm GCN ATTP: </td>
                                                
                                                @forelse($getGiayPhepATTP as $ATTP)

                                                    <td class="td-default" >{{$ATTP['chualam']}}</td>
                                                @empty
                                                @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                    </html>