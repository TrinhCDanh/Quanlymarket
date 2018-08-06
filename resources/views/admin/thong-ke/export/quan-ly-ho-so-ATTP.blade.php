                                   <html> 
                                     <tr>
                                            <td style="text-align: center;font-weight: bold;" colspan="3">ỦY BAN NHÂN DÂN QUẬN 5</td>
                                            @for($i=0;$i < 5;$i++)
                                            <td></td>
                                            @endfor
                                            <td style="text-align: center;font-weight: bold;" colspan="3">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>   
                                     </tr>
                                               <tr>

                                                    <td style="text-align: center;font-weight: bold;" colspan="3">PHÒNG KINH TẾ</td>
                                                     @for($i=0;$i < 5;$i++)
                                            <td></td>
                                            @endfor
                                                    <td style="text-align: center;font-weight: bold;" colspan="3">ĐỌC LẬP TỰ DO HẠNH PHÚC</td>
                                               </tr>                      
                                       <tr>
                                       <td colspan="11"><h3 style="text-align: center;">QUẢN LÝ HỒ SƠ AN TOÀN THỰC PHẨM</h3></td>
                                         </tr>
                                   
                                    <table>
                                    <thead >
                                    <tr>
                                         <th >STT</th>
                                        <th >Họ tên chủ hộ kinh doanh</th>
                                        <th >Mã quầy/sạp</th>
                                        <th >GCN ĐKKD</th>
                                        <th >Giấy chứng nhận đủ điều kiện ATTP</th>
                                        <th >Bản cam kết</th>
                                        <th >Khám sức khỏe</th>
                                        <th >Giấy xác nhận kiến thức ATTP</th>
                                        <th >Số lao động</th>
                                        <th >Ghi chú</th>
                                    </tr>
                                   
                                    </thead>
                                    <tbody>
                                    @forelse($list as $index => $item)
                                        <tr>
                                            <td style="text-align: center">{{$index+1}}</td>
                                            <td style="text-align: center">{{$item->ten_ho_kd}}</td>
                                            <td style="text-align: center">{{$item->getSap->first()['ma_so_sap']}}</td>
                                            <td style="text-align: center">{{$item->ma_so_ho_kd}}</td>
                                            <td style="text-align: center">{{$item->GCN_du_dieu_kien == 1 ? 'Có' : 'Không có'}} </td>
                                            <td style="text-align: center">{{$item->ban_cam_ket_dam_bao == 1 ? 'Có' : 'Không có'}}</td>
                                            <td style="text-align: center">{{$item->kham_suc_khoe == 1 ? 'Có' : 'Không có'}}</td>
                                            <td style="text-align: center">{{$item->giay_xac_nhan_kie_thuc == 1 ? 'Có' : 'Không có'}}</td>
                                            <td style="text-align: center">{{$item->so_lao_dong}}</td>
                                            <td style="text-align: center">{{$item->ghi_chu}}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                   
                                </table>
                                    </html>