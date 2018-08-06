                                   <html> 
                                     <tr>
                                            <td style="text-align: center;font-weight: bold;">ỦY BAN NHÂN DÂN QUẬN 5</td>
                                            @for($i=1; $i < $getListCho->count();$i++)
                                            <td></td>
                                            @endfor
                                            <td style="text-align: center;font-weight: bold;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>   
                                     </tr>
                                               <tr>

                                                    <td style="text-align: center;font-weight: bold;">PHÒNG KINH TẾ</td>
                                                     @for($i=1; $i < $getListCho->count();$i++)
                                            <td></td>
                                            @endfor
                                                    <td style="text-align: center;font-weight: bold;">ĐỌC LẬP TỰ DO HẠNH PHÚC</td>
                                               </tr>                      
                                       <tr>
                                       <td colspan="{{$getListCho->count()+1}}"><h3 style="text-align: center;">BÁO CÁO TÌNH HÌNH KÊ KHAI CÁC MẶT HÀNG KINH DOANH TẠI CHỢ TRUYỀN THỐNG</h3></td>
                                         </tr>
                                   
                                    <table style="border:1px dashed #CCC" >
                                        <thead>
                                            <tr>
                                               
                                                <th >Nội dung</th>
                                                
                                                @forelse($getListCho as $cho)

                                                <th>{{$cho->ten}}</th>
                                                @empty
                                            @endforelse


                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="font-weight: bold;">Số hộ kinh doanh thực phẩm</td>
                                                @forelse($listSoHoKinhDoanh as $ho)
                                                <td style="text-align:center">{{$ho['tong']}}</td>
                                                @empty 
                                                @endforelse
                                            </tr>
                                              <tr>
                                                <td style="font-weight: bold;">Số hộ thực hiện kê khai:</td>
                                                 @forelse($getSoHoKeKhai as $kekhai)
                                                <td style="text-align:center">{{$kekhai['tongsokekhai']}}</td>
                                                @empty 
                                                @endforelse
                                               
                                            </tr>
                                             <tr>
                                                <td style="font-weight: bold;">Chiếm tỷ lệ (%):</td>
                                                @forelse($getSoHoKeKhai as $kekhai)
                                                <td style="text-align:center">{{round($kekhai['tiso'],2)}} %</td>
                                                @empty 
                                                @endforelse

                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold;">Trong đó</td>
        
                                            </tr>
                                            @forelse($getListCho as $key => $cho) 
                                            @if($key == 0) 
                                            @forelse($getListNganh as $nganh)


                                            <tr>
                                                <td >{{$nganh->ten_nganh}}</td>

                                                @forelse($getListKeKhai as $KeKhai) @forelse($KeKhai as $data) @if($data['nganh'] == $nganh->id)
                                                <td style="text-align:center">{{$data['soluong']}}</td>
                                                @endif @empty @endforelse @empty @endforelse

                                            </tr>
                                            @empty @endforelse @endif @empty @endforelse


                                            <tr>
                                                <td style="font-weight: bold;">Về GCN ATTP</td>

                                            </tr>
                                            <tr>
                                                <td>Số hộ đã cấp GCN ATTP: </td>
                                                @forelse($getGiayPhepATTP as $ATTP)

                                                    <td style="text-align:center">{{$ATTP['dalam']}}</td>
                                                @empty
                                                @endforelse
                                                
                                            </tr>
                                            <tr>
                                                <td>Số hộ đang làm GCN ATTP:</td>
                                             
                                                @forelse($getGiayPhepATTP as $ATTP)

                                                    <td style="text-align:center">{{$ATTP['danglam']}}</td>
                                                @empty
                                                @endforelse
                                            </tr>
                                            <tr>
                                                <td>Số hộ chưa làm GCN ATTP: </td>
                                                
                                                @forelse($getGiayPhepATTP as $ATTP)

                                                    <td style="text-align:center">{{$ATTP['chualam']}}</td>
                                                @empty
                                                @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                    </html>