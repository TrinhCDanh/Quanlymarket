<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\SapRepositoryInterface;
use App\Repositories\Contracts\ChoRepositoryInterface;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\DonViTinhRepositoryInterface;
use App\Repositories\Contracts\CoSoCungCapRepositoryInterface;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Excel;



class AjaxController extends Controller
{
    private $sap;
    private $cho;
    private $hoKinhDoanh;
    private $donViTinh;
    private $coSoCungCap;
    private $nganhKinhDoanh;


    public function __construct(SapRepositoryInterface $sapRepository,
                                ChoRepositoryInterface $choRepository,
                                HoKinhDoanhRepositoryInterface $hoKinhDoanhRepository,
                                DonViTinhRepositoryInterface $donViTinhRepository,
                                CoSoCungCapRepositoryInterface $coSoCungCapRepository,
                                NganhKinhDoanhRepositoryInterface $nganhKinhDoanhRepository)

    {
        $this->sap = $sapRepository;
        $this->cho = $choRepository;
        $this->hoKinhDoanh = $hoKinhDoanhRepository;
        $this->donViTinh = $donViTinhRepository;
        $this->coSoCungCap = $coSoCungCapRepository;
        $this->nganhKinhDoanh = $nganhKinhDoanhRepository;
    }
    public function getListSap(Request $request)
    {
        if ($request->get('id_cho') != null  && $request->get('id_ho_kinh_doanh') == null) {

           // danh sach cac sap chua thuoc ho kinh doanh nao cua 1 cho
            $data = $this->sap->getListByMultiColumn([
                'id_cho'=>$request->get('id_cho'),
                'id_ho_kinh_doanh' => null
                ]);

        }
        elseif ($request->get('id_cho') != null ) {
            //danh sach cac sap trong 1 cho
//            $data = $this->sap->getListByMultiColumn([
//                'id_cho'=>$request->get('id_cho'),
//            ]);
//            $data = $this->sap->getListSapByID($request->get('id_ho_kinh_doanh'),$request->get('id_cho'));
//            $data = $this->sap->all();
//            $data = $data->where('id_cho',84)
//                        ->orWhere('id_ho_kinh_doanh',null);
//          $data = DB::table('sap')
//                ->where('id_cho', $request->get('id_cho'))
//                ->orWhere ('id_ho_kinh_doanh', $request->get('id_ho_kinh_doanh'))
//                ->orWhere('id_ho_kinh_doanh', null)
//                ->get();
//            echo $data;
            //dd($request->get('id_ho_kinh_doanh'));
            $data = DB::select('SELECT * FROM sap where id_cho = ? and delete_at = 0 and ( id_ho_kinh_doanh = ? or id_ho_kinh_doanh is null )'
                ,[$request->get('id_cho'),$request->get('id_ho_kinh_doanh')]);
//            echo 111;
//dd($data);
        }else {
            $data = $this->sap->all();
        }

        $array = [];
        if ($data) {
            foreach ($data as $d) {
               // if($d->id_ho_kinh_doanh ==null)
                {
                    $array[] = [
                        'id' => $d->id,
                        'ten' => $d->ten ,
                        'ma_so_sap'=> $d->ma_so_sap,
                        'id_ho_kinh_doanh' => $d->id_ho_kinh_doanh
                    ];
                }
            }
        }
        return $this->dataSuccess('Success', $array);
    }

    //import đơn vị tính
    public function importDonViTinh(Request $request)
    {
        // Excel::load(Input::file('file_import'),function($reader){
        //     $reader->each(function($sheet){
        //         foreach ($sheet->toArray() as $row) {
        //             # code...
        //             User::firstOrCreate($sheet->toArray());
        //         }
        //     });
        // });
        // echo "import thành công";
         if ($request->hasFile('file_import')) {
            $path = $request->file('file_import')->getRealPath();
            $data = \Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                $ok = true;
                $errors = [];
                $insert = [];
                foreach ($data as $key => $value) {
                    if ($value->ten !='') {
                        $insertDonViTinh = [
                            'id' => $value->id,
                            'ten' => $value->ten,
                        ];
                        $DonViTinh = $this->donViTinh->getByColumn('ten',$value->ten);
                        if ($DonViTinh != null) {
                            $ok = false;
                            $errors[] = 'Tên' . $value->ten . ' đã tồn tại ';
                        }
                        $argv['don_vi_tinh'] = $insertDonViTinh;
                        $insert[] = $argv;
                    }
                }
                if ($ok == false) {
                    return $this->dataError('Fail', $errors);
                } else {


                    if (!empty($insert) && $ok == true) {
                        foreach ($insert as $in) {
                            try {
                                DB::table('don_vi_tinh')->insert($in['don_vi_tinh']);
                            } catch (\Exception $exception) {
                                return $this->dataError($exception->getMessage(), []);
                            }
                        }
                        return $this->dataSuccess('Success', []);
                    }
                }
            }
            return $this->dataError('Fail', []);
        } else {
            return $this->dataError('Error', []);
        }
    }
    //import cơ sở cung cấp
    public function importCoSoCungCap(Request $request)
    {
        // Excel::load(Input::file('file_import'),function($reader){
        //     $reader->each(function($sheet){
        //         foreach ($sheet->toArray() as $row) {
        //             # code...
        //             User::firstOrCreate($sheet->toArray());
        //         }
        //     });
        // });
        // echo "import thành công";
         if ($request->hasFile('file_import')) {
            $path = $request->file('file_import')->getRealPath();
            $data = \Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                $ok = true;
                $errors = [];
                $insert = [];
                foreach ($data as $key => $value) {
                    if ($value->ten_co_so !='' || $value->so_dien_thoai !='' || $value->dia_chi !='') {
                        $insertCoSoCungCap = [
                            'id' => $value->id,
                            'ten' => $value->ten_co_so,
                            'sdt'=>$value->so_dien_thoai,
                            'dia_chi'=>$value->dia_chi
                        ];
                        $CoSoCungCap = $this->coSoCungCap->getByMultiColumn(['ten'=>$value->ten_co_so,'sdt'=>$value->so_dien_thoai,'dia_chi'=>$value->dia_chi]);
                        $CoSoCungCap1  = $this->coSoCungCap->getByColumn('ten',$value->ten_co_so);
                        $CoSoCungCap2 = $this->coSoCungCap->getByColumn('sdt',$value->so_dien_thoai);

                        if ($CoSoCungCap != null) {
                            $ok = false;
                            $errors[] = 'Tên' . $value->ten_co_so . ' đã tồn tại ';
                            $errors[] = 'SDT' . $value->so_dien_thoai . ' đã tồn tại ';
                        }
                        elseif ($CoSoCungCap1 != null) {
                            $ok = false;
                            $errors[] = 'Tên' . $value->ten_co_so . ' đã tồn tại ';
                            //$errors[] = 'SDT' . $value->so_dien_thoai . ' exit ';
                        }
                        elseif ($CoSoCungCap2 != null) {
                            $ok = false;
                            $errors[] = 'SDT' . $value->so_dien_thoai . ' đã tồn tại ';
                            //$errors[] = 'SDT' . $value->so_dien_thoai . ' exit ';
                        }
                        $argv['co_so_cc'] = $insertCoSoCungCap;
                        $insert[] = $argv;
                    }
                }
                if ($ok == false) {
                    return $this->dataError('Fail', $errors);
                } else {


                    if (!empty($insert) && $ok == true) {
                        foreach ($insert as $in) {
                            try {
                                DB::table('co_so_cc')->insert($in['co_so_cc']);
                            } catch (\Exception $exception) {
                                return $this->dataError($exception->getMessage(), []);
                            }
                        }
                        return $this->dataSuccess('Success', []);
                    }
                }
            }
            return $this->dataError('Fail', []);
        } else {
            return $this->dataError('Error', []);
        }
    }
    //import sạp
    public function importSap(Request $request)
    {
        // Excel::load(Input::file('file_import'),function($reader){
        //     $reader->each(function($sheet){
        //         foreach ($sheet->toArray() as $row) {
        //             # code...
        //             User::firstOrCreate($sheet->toArray());
        //         }
        //     });
        // });
        // echo "import thành công";
         if ($request->hasFile('file_import')) {
            $path = $request->file('file_import')->getRealPath();
            $data = \Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                $ok = true;
                $errors = [];
                $insert = [];
                //dd($data);
                foreach ($data as $key => $value) {
                        if ($value->ma_so_sap !='' || $value->ten !=''|| $value->cho!='') {
                            //lấy id chợ
                            $idCho = $this->cho->getByColumn('ten',$value->cho);
                            $insertSap = [
                                'id' => $value->id,
                                'ma_so_sap' => $value->ma_so_sap,
                                'ten'=>$value->ten,
                                'id_cho'=> isset($idCho) ? $idCho->id : null,
                                'delete_at'=>0
                            ];
                        // $Sap = $this->sap->getByMultiColumn(['ma_so_sap'=>$value->ma_so_sap,'ten'=>$value->ten]);
                        // if ($Sap != null) {
                        //     $ok = false;
                        //     $errors[] = 'Mã số' . $value->ma_so_sap . ' exit ';
                        //     $errors[] = 'Tên' . $value->ten . ' exit ';
                        // }
                        $argv['sap'] = $insertSap;
                        $insert[] = $argv;
                    }
                }

                if ($ok == false) {
                    return $this->dataError('Fail', $errors);
                } else {


                    if (!empty($insert) && $ok == true) {
                        foreach ($insert as $in) {
                            try {
                                DB::table('sap')->insert($in['sap']);
                            } catch (\Exception $exception) {
                                return $this->dataError($exception->getMessage(), []);
                            }
                        }
                        return $this->dataSuccess('Success', []);
                    }
                }
            }
            return $this->dataError('Fail', []);
        } else {
            return $this->dataError('Error', []);
        }
    }

    public function importHoKinhDoanh(Request $request)
    {
        // Excel::load(Input::file('file_import'),function($reader){
        //     $reader->each(function($sheet){
        //         foreach ($sheet->toArray() as $row) {
        //             # code...
        //             User::firstOrCreate($sheet->toArray());
        //         }
        //     });
        // });
        // echo "import thành công";
         if ($request->hasFile('file_import')) {
            $path = $request->file('file_import')->getRealPath();
            $data = \Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                $ok = true;
                $errors = [];
                $insert = [];
                //dd($data);
                foreach ($data as $key => $value) {
                    $row = $key+2;
                        if ($value->so_ho_kd !='' || $value->ten_ho_kinh_doanh !='' || $value->dia_chi !='' || 
                            $value->tang !=''  || $value->so_dien_thoai_ho_kd !='' || $value->fax_ho_kinh_doanh !='' || 
                            $value->email !='' || $value->website !='' || $value->nganh_nghe !='' || 
                            $value->von_kinh_doanh !='' || $value->ho_chu_ho_kd !='' || $value->ten_chu_ho_kd !='' || 
                            $value->gioi_tinh !='' || $value->ngay_sinh !='' || $value->dan_toc !='' || $value->quoc_tich !='' ||
                            $value->so_dien_thoai_chu_ho_kd !='' || $value->loai_giay_to !='' || 
                            $value->ma_so_giay_to !='' || $value->ngay_cap_giay_to !='' || $value->noi_cap !='' || 
                            $value->dia_chi_thuong_tru !='' || $value->dia_chi_tam_tru !='' || $value->sap !='' ||
                            $value->ngay_dang_ki_dau_tien !='' || $value->so_lan_thay_doi != '' || $value->ngay_thay_doi !='' ||
                            $value->trang_thai_giay_attp !='' || $value->ma_so_giay_attp !='' || $value->thoi_gian_hieu_luc_attp !='' ||
                            $value->kham_suc_khoe !='' || $value->giay_xac_nhan_kien_thuc !='' ||
                            $value->gcn_du_dieu_kien != '' || $value->ban_cam_ket_dam_bao !='' || $value->nguoi_cap !='' ||
                            $value->noi_cap_giay_attp !='' || $value->ngay_cap_giay_attp !='') 
                        {
                            //Lấy địa chỉ chợ
                            $diaChi = $this->cho->getByColumn('dia_chi',trim($value->dia_chi));
                            if($diaChi == null)
                            {
                                $ok = false;
                                $errors[] = 'Dòng '.$row.' địa chỉ '.$value->dia_chi.' không tồn tại ';
                            }else{
                                //Lấy ngành nghề
                                $nganhNghe = $this->nganhKinhDoanh->getByColumn('ten_nganh',trim($value->nganh_nghe));
                                if($nganhNghe == null)
                                {
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' ngành nghề '.$value->nganh_nghe.' không tồn tại ';
                                }
                                //Giới tính
                                if(trim($value->gioi_tinh) == 'Nam'){
                                    $gioiTinh = 1;
                                }elseif(trim($value->gioi_tinh) == 'Nữ'){
                                    $gioiTinh = 2;
                                }else{
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' giới tính '.$value->gioi_tinh.' không tồn tại ';
                                }
                                //Loại giấy tờ
                                if(trim($value->loai_giay_to) == 'CMND'){
                                    $loaiGiayTo = 1;
                                }elseif(trim($value->loai_giay_to) == 'CCCD'){
                                    $loaiGiayTo = 2;
                                }else{
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' loại giấy tờ '.$value->loai_giay_to.' không tồn tại ';
                                }
                                //So sanh ngày đăng ký và ngày thay đổi
                                if(($value->ngay_dang_ki_dau_tien) > ($value->ngay_thay_doi)){
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' ngày thay đổi phải lớn hơn ngày đăng kí đầu tiên';
                                }
                                //Trạng thái giấy ATTP
                                if(trim($value->trang_thai_giay_attp) == 'Chưa làm'){
                                    $trangThaiGiayATTP = 2;
                                }elseif(trim($value->trang_thai_giay_attp) == 'Đang làm'){
                                    $trangThaiGiayATTP = 1;
//                                }elseif(trim($value->trang_thai_giay_attp) == 'Đã làm'){
//                                    $trangThaiGiayATTP = 2;
                                }elseif(trim($value->trang_thai_giay_attp) == 'Đã cấp'){
                                    $trangThaiGiayATTP = 0;
                                }elseif(trim($value->trang_thai_giay_attp) == null){
                                    $trangThaiGiayATTP = null;    
                                }else{
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' trạng thái giấy tờ '.$value->trang_thai_giay_attp.' không tồn tại ';
                                }
                                //Khám sức khỏe
                                if(trim($value->kham_suc_khoe) == 'Có'){
                                    $khamSucKhoe = 1;
                                }elseif(trim($value->kham_suc_khoe) == 'Không'){
                                    $khamSucKhoe = 0;
                                }elseif(trim($value->kham_suc_khoe) == null){
                                    $khamSucKhoe = null;
                                }else{
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' khám sức khỏe '.$value->kham_suc_khoe.' không tồn tại ';
                                }
                                //Giấy xác nhận kiến thức
                                if(trim($value->giay_xac_nhan_kien_thuc) == 'Có'){
                                    $giayXacNhanKienThuc = 1;
                                }elseif(trim($value->giay_xac_nhan_kien_thuc) == 'Không'){
                                    $giayXacNhanKienThuc = 0;
                                }elseif(trim($value->giay_xac_nhan_kien_thuc) == null){
                                    $giayXacNhanKienThuc = null;
                                }else{
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' giấy xác nhận kiến thức '.$value->giay_xac_nhan_kien_thuc.' không tồn tại ';
                                }
                                //GCN đủ điều kiện
                                if(trim($value->gcn_du_dieu_kien) == 'Có'){
                                    $gcnDuDieuKien = 1;
                                }elseif(trim($value->gcn_du_dieu_kien) == 'Không'){
                                    $gcnDuDieuKien = 0;
                                }elseif(trim($value->gcn_du_dieu_kien) == null){
                                    $gcnDuDieuKien = null;
                                }else{
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' giấy chứng nhận đủ điều kiện '.$value->gcn_du_dieu_kien.' không tồn tại ';
                                }
                                //Bản cam kết đảm bảo
                                if(trim($value->ban_cam_ket_dam_bao) == 'Có'){
                                    $banCamKetDamBao = 1;
                                }elseif(trim($value->ban_cam_ket_dam_bao) == 'Không'){
                                    $banCamKetDamBao = 0;
                                }elseif(trim($value->ban_cam_ket_dam_bao) == null){
                                    $banCamKetDamBao = null;
                                }else{
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' bản cam kết đảm bảo '.$value->ban_cam_ket_dam_bao.' không tồn tại ';
                                }
                                //Ngày sinh
                                // $birthday = convertVietNamDateToEn($value->ngay_sinh);

                                // if ($birthday == null) {
                                //     $ok = false;
                                //     $errors[] = 'Ngày sinh '.$value->ngay_sinh.' không đúng định dạng ';
                                // }
                                $insertHoKinhDoanh = [
                                    'id' => $value->id,
                                    'ma_so_ho_kd' => $value->so_ho_kd,
                                    'ten_ho_kd'=>$value->ten_ho_kinh_doanh,
                                    'id_cho'=> isset($diaChi) ? $diaChi->id : null,
                                    'tang'=>$value->tang,
                                    'sdt_ho_kd'=>$value->so_dien_thoai_ho_kd,
                                    'fax_ho_kd'=>$value->fax_ho_kinh_doanh,
                                    'email_ho_kd'=>$value->email,
                                    'website'=>$value->website,
                                    'id_nganh_kd'=> isset($nganhNghe) ? $nganhNghe->id : null,
                                    'von_kd' => trim($value->von_kinh_doanh),
                                    'ho_chu_ho_kd'=>$value->ho_chu_ho_kd,
                                    'ten_chu_ho_kd'=>$value->ten_chu_ho_kd,
                                    'gioi_tinh'=>isset($gioiTinh) ? $gioiTinh : null,
                                    'ngay_sinh'=>$value->ngay_sinh,
                                    'dan_toc'=>$value->dan_toc,
                                    'quoc_tich'=>$value->quoc_tich,
                                    'sdt_chu_ho_kd'=>$value->so_dien_thoai_chu_ho_kd,
                                    'loai_giay_to'=>isset($loaiGiayTo) ? $loaiGiayTo : null,
                                    'ma_so_giay_to'=>$value->ma_so_giay_to,
                                    'ngay_cap_giay_to'=>$value->ngay_cap_giay_to,
                                    'noi_cap'=>$value->noi_cap,
                                    'dia_chi_thuong_tru'=>$value->dia_chi_thuong_tru,
                                    'dia_chi_tam_tru'=>$value->dia_chi_tam_tru,
                                    'ngay_dang_ki_1st'=>$value->ngay_dang_ki_dau_tien,
                                    'so_lan_thay_doi'=>$value->so_lan_thay_doi,
                                    'ngay_thay_doi'=>$value->ngay_thay_doi,
                                    'giay_ATTP_Status'=>isset($trangThaiGiayATTP) ? $trangThaiGiayATTP : null,
                                    'ma_so_giay_ATTP'=>$value->ma_so_giay_attp,
                                    'thoi_gian_hieu_luc_ATTP'=>$value->thoi_gian_hieu_luc_attp,
                                    'kham_suc_khoe'=>isset($khamSucKhoe) ? $khamSucKhoe : null,
                                    'giay_xac_nhan_kien_thuc'=>isset($giayXacNhanKienThuc) ? $giayXacNhanKienThuc : null,
                                    'GCN_du_dieu_kien'=>isset($gcnDuDieuKien) ? $gcnDuDieuKien : null,
                                    'ban_cam_ket_dam_bao'=>isset($banCamKetDamBao) ? $banCamKetDamBao : null,
                                    'nguoi_cap'=>trim($value->nguoi_cap),
                                    'noi_cap_giay_ATTP'=>trim($value->noi_cap_giay_attp),
                                    'ngay_cap_giay_ATTP'=>$value->ngay_cap_giay_attp,
                                    'delete_at'=>0
                                ];
                                $hoKinhDoanh = $this->hoKinhDoanh->getByMultiColumn(['ma_so_ho_kd'=>$value->so_ho_kd]);
                                if ($hoKinhDoanh != null) {
                                    $ok = false;
                                    $errors[] = 'Mã số hộ kinh doanh ' . $value->so_ho_kd . ' đã tồn tại ';
                                    //$errors[] = 'Số điện thoại hộ kd' . $value->so_dien_thoai_ho_kd . ' exit ';
                                }
                                $tenSap = [];
                                $sap = [];
                                $tenSapLoi = [];
                                $tenSapKoTonTai = [];
                                $tenSap = getChuoiSap($value->sap);
                                //Lấy idCho
                                $idCho = isset($diaChi) ? $diaChi->id : null;
                                $dataCho = $this->cho->getTenCho($idCho);
                                $tenCho = $dataCho[0]->ten;
                                //Lấy mãng idSap
                                foreach($tenSap as $ten){
                                    $temp = DB::table('sap')->select('id','ten')->where('ten',$ten)->where('id_cho',$idCho)->get()->toArray();
                                    if($temp == null){
                                        //Lấy tên sạp không tồn tại in ra mảng
                                        array_push($tenSapKoTonTai,$ten);
                                    }
                                    array_push($tenSapLoi,DB::table('sap')->select('id','ten')->where('ten',$ten)->where('id_cho',$idCho)->get()->toArray());
                                }
                                //đếm số id sạp
                                $countSap = count($tenSapLoi);
                                //Xóa id sạp không tồn tại 
                                for($i=0; $i<$countSap ; $i++)
                                {   
                                    if(($tenSapLoi[$i]) == null)
                                    {
                                        unset($tenSapLoi[$i]);
                                    }
                                }
                                //Đếm số id sạp sau khi xóa
                                $countSapLoi = count($tenSapLoi);
                                if($countSapLoi < $countSap)
                                {
                                    $ok = false;
                                    $errors[] = 'Dòng '.$row.' tên '.implode(", ",$tenSapKoTonTai).' không tồn tại trong '.$tenCho;
                                    //$errors[] = 'Tên không tồn tại trong '.$tenCho;
                                }
                                //Lấy mãng id sạp tồn tại
                                foreach($tenSapLoi as $tenLoi)
                                {   
                                    array_push($sap,$this->sap->getIdSap($tenLoi[0]->ten,$idCho));
                                }
                                //save
                                $argv['sap']= $sap;
                                $argv['ho_kinh_doanh'] = $insertHoKinhDoanh;
                                $insert[] = $argv;
                            }
                        }
                        else{
                            $ok = false;
                            $errors[] = 'Không đúng bản mẫu Excel';
                        }
                    }

                if ($ok == false) {
                    return $this->dataError('Fail', $errors);
                } else {


                    if (!empty($insert) && $ok == true) {
                        foreach ($insert as $in) {
                            try {
                                DB::table('ho_kinh_doanh')->insert($in['ho_kinh_doanh']);
                                //Lấy Mã số kinh doanh
                                $maHoKinhDoanh = $in['ho_kinh_doanh']['ma_so_ho_kd'];
                                //Lấy id_ho_kinh_doanh
                                $idHoKinhDoanh = DB::table('ho_kinh_doanh')->select('id')->where('ma_so_ho_kd',$maHoKinhDoanh)->get();
                                $idSap = $in['sap'];
                                $updateSap = $this->sap->updateIdHoKinhDoanh([$idSap], $idHoKinhDoanh[0]->id);



                                if($insert)
                                {
                                    $id = $idHoKinhDoanh[0]->id;
                                    $ho_kinh_doanh_detail = DB::table('ho_kinh_doanh')->where('id',$id)->get();

                                    foreach ($ho_kinh_doanh_detail as $item) {
                                        if (trim($item->gioi_tinh) == 'Nam') {
                                            $gioiTinh = 1;
                                        } elseif (trim($item->gioi_tinh) == 'Nữ') {
                                            $gioiTinh = 2;
                                        } else {
                                            $ok = false;
                                            $errors[] = 'Dòng ' . $row . ' giới tính ' . $item->gioi_tinh . ' không tồn tại ';
                                        }
                                        //Loại giấy tờ
                                        if (trim($item->loai_giay_to) == 'CMND') {
                                            $loaiGiayTo = 1;
                                        } elseif (trim($item->loai_giay_to) == 'CCCD') {
                                            $loaiGiayTo = 2;
                                        } else {
                                            $ok = false;
                                            $errors[] = 'Dòng ' . $row . ' loại giấy tờ ' . $item->loai_giay_to . ' không tồn tại ';
                                        }
                                        //So sanh ngày đăng ký và ngày thay đổi
                                        if (($item->ngay_dang_ki_1st) > ($item->ngay_thay_doi)) {
                                            $ok = false;
                                            $errors[] = 'Dòng ' . $row . ' ngày thay đổi phải lớn hơn ngày đăng kí đầu tiên';
                                        }

                                        $insertHoKinhDoanhDetail = [
                                            'id_ho_kinh_doanh' => $item->id,
                                            'ma_so_ho_kd' => $item->ma_so_ho_kd,
                                            'ten_ho_kd' => $item->ten_ho_kd,
                                            'id_cho' => $item->id_cho,
                                            'tang' => $item->tang,
                                            'sdt_ho_kd' => $item->sdt_ho_kd,
                                            'fax_ho_kd' => $item->fax_ho_kd,
                                            'email_ho_kd' => $item->email_ho_kd,
                                            'website' => $item->website,
                                            'id_nganh_kd' => $item->id_nganh_kd,
                                            'von_kd' => trim($item->von_kd),
                                            'ho_chu_ho_kd' => $item->ho_chu_ho_kd,
                                            'ten_chu_ho_kd' => $item->ten_chu_ho_kd,
                                            'gioi_tinh' => isset($gioiTinh) ? $gioiTinh : null,
                                            'ngay_sinh' => $item->ngay_sinh,
                                            'dan_toc' => $item->dan_toc,
                                            'quoc_tich' => $item->quoc_tich,
                                            'sdt_chu_ho_kd' => $item->sdt_chu_ho_kd,
                                            'loai_giay_to' => isset($loaiGiayTo) ? $loaiGiayTo : null,
                                            'ma_so_giay_to' => $item->ma_so_giay_to,
                                            'ngay_cap_giay_to' => $item->ngay_cap_giay_to,
                                            'noi_cap' => $item->noi_cap,
                                            'dia_chi_thuong_tru' => $item->dia_chi_thuong_tru,
                                            'dia_chi_tam_tru' => $item->dia_chi_tam_tru,
                                            'ngay_dang_ki_1st' => $item->ngay_dang_ki_1st,
                                            'so_lan_thay_doi' => $item->so_lan_thay_doi,
                                            'ngay_thay_doi' => $item->ngay_thay_doi,
                                            'giay_ATTP_Status' => isset($item->giay_ATTP_Status) ? $item->giay_ATTP_Status : null,
                                            'ma_so_giay_ATTP' => $item->ma_so_giay_ATTP,
                                            'thoi_gian_hieu_luc_ATTP' => $item->thoi_gian_hieu_luc_ATTP,
                                            'kham_suc_khoe' => isset($item->kham_suc_khoe) ? $item->kham_suc_khoe : null,
                                            'giay_xac_nhan_kien_thuc' => isset($item->giay_xac_nhan_kien_thuc) ? $item->giay_xac_nhan_kien_thuc : null,
                                            'GCN_du_dieu_kien' => isset($item->GCN_du_dieu_kien) ? $item->GCN_du_dieu_kien : null,
                                            'ban_cam_ket_dam_bao' => isset($item->ban_cam_ket_dam_bao) ? $item->ban_cam_ket_dam_bao : null,
                                            'nguoi_cap' => trim($item->nguoi_cap),
                                            'noi_cap_giay_ATTP' => trim($item->noi_cap_giay_ATTP),
                                            'ngay_cap_giay_ATTP' => $item->ngay_cap_giay_ATTP,
                                            'so_lao_dong' => $item->so_lao_dong,
                                        ];
                                    }

                                    DB::table('ho_kinh_doanh_log_detail')->insert($insertHoKinhDoanhDetail);
                                }
                            } catch (\Exception $exception) {
                                return $this->dataError($exception->getMessage(), []);
                            }
                        }
                        return $this->dataSuccess('Success', []);
                    }
                }
            }
            return $this->dataError('Fail', []);
        } else {
            return $this->dataError('Error', []);
        }
    }

    public function getDiaChi(Request $request)
    {
        if ($request->get('id')) {
            $data = $this->cho->getListByColumn('id',$request->get('id'));

        } else {
            $data = $this->cho->all();
        }

        $array = [];
        if ($data) {
            foreach ($data as $d) {
                    $array[] = ['id' => $d->id, 'dia_chi' => $d->dia_chi];
            }
        }
        return $this->dataSuccess('Success', $array);

    }
    public function getSap(Request $request)
    {
        if ($request->get('id_cho') != null) {
            $data = $this->sap->getListByColumn(
                'id_cho', $request->get('id_cho'));
        }
        else {
                $data = $this->sap->all();
        }
        $array = [];
        if ($data) {
            foreach ($data as $d) {
                $array[] = ['id' => $d->id, 'ten_sap' => $d->ten];
            }
        }
        return $this->dataSuccess('Success', $array);

    }
    public function uploadFile(Request $request){
        if ($request->hasFile('file')){
            $nameFile = '';
            $file = $request->file('file');

            $name = time().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $name);
            return $this->dataSuccess('Success', ['file' => $name]);
        }
        else{
            return $this->dataError('UpLoad Fail', []);
        }
    }
}
