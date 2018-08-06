<?php

namespace App\Http\Controllers\Admin;
use Excel;
// use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PHPExcel_Worksheet_PageSetup;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MatHangKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\DonViTinhRepositoryInterface;
use App\Repositories\Contracts\CoSoCungCapRepositoryInterface;
use App\Repositories\Contracts\SapRepositoryInterface;

class MatHangKinhDoanhController extends Controller
{
    private $matHangKinhDoanh;
    private $hoKinhDoanh;
    private $nganhKD;
    private $donViTinh;
    private $coSoCungCap;
    private $sap;

    public function __construct(MatHangKinhDoanhRepositoryInterface $MatHangKinhDoanhRepository,
                                HoKinhDoanhRepositoryInterface $HoKinhDoanhRepository,
                                NganhKinhDoanhRepositoryInterface $NganhKinhDoanhRepository,
                                DonViTinhRepositoryInterface $DonViTinhRepository,
                                CoSoCungCapRepositoryInterface $CoSoCungCapRepository,
                                SapRepositoryInterface $SapRepository)
    {
        $this->matHangKinhDoanh = $MatHangKinhDoanhRepository;
        $this->hoKinhDoanh = $HoKinhDoanhRepository;
        $this->nganhKD = $NganhKinhDoanhRepository;
        $this->donViTinh = $DonViTinhRepository;
        $this->coSoCungCap = $CoSoCungCapRepository;
        $this->sap = $SapRepository;
    }

    public function index(Request $request, $id_ho) {
        $view = [];
        $list = $this->matHangKinhDoanh->getListMatHangKinhDoanhByHo($id_ho, 15, '', $request->all());

        // dd($list['data']);
        $view['list'] = $list['data'];
        $view['cho'] = $list['cho'];
        $view['phuong'] = $list['phuong'];
        // $view['nganhKinhDoanh'] = $list['nganhKinhDoanh'];
        $view['paginate'] = $list['paginate'];
        $view['ho_info'] = $list['ho_info'];
        $view['id_ho'] = $id_ho;
        $view['coSoCungCap'] = $this->coSoCungCap->all();
        $view['sap'] = $this->sap->getByColumn('id_ho_kinh_doanh', $id_ho);
        return view('admin.danh-sach-mat-hang-kd.list', $view);
    }

    public function export(Request $request, $id_ho){
        if($request->type=='excel'){
            // $getList = $this->matHangKinhDoanh->getListMatHangKinhDoanhByHo(4, 15, '', $request->all());
            // Excel::load( 'public/excel/mat_hang_kd_theo_ho.xlsx', function ( $excel ) use($getList) {
                //edit here
            // })->export( 'xls' );
            $getList = $this->matHangKinhDoanh->getListMatHangKinhDoanhByHo($id_ho, 100, '', $request->all());
            $export = Excel::create('mat_hang_kinh_doanh_theo_ho_KD-'.$getList['ho_info']->ma_so_ho_kd, function($excel) use($getList) {
                $excel->sheet('MatHangKD', function($sheet) use($getList) {
                    $sheet->setorientation('landscape')->setpaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                    $sheet->loadView('admin.danh-sach-mat-hang-kd.export',[
                        'getListMatHang' => $getList['data'],
                        'ho_info' => $getList['ho_info']
                    ]);
                    $sheet->getStyle('A14:I14')->getAlignment()->setWrapText(true)->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $sheet->setBorder('A14:I'.(count($getList['data'])+14), 'thin');
                });
            })->store('xls',storage_path('excel/exports'))->export('xls');
            // ->download('xls');
        }
        else{
            // $this->export_pdf($request, $id_ho);
            $getList = $this->matHangKinhDoanh->getListMatHangKinhDoanhByHo($id_ho, 100, '', $request->all());
            $pdf = PDF::loadView('admin.danh-sach-mat-hang-kd.export_pdf', [
                'getListMatHang' => $getList['data'],
                'ho_info' => $getList['ho_info']
            ])->setPaper('a3', 'landscape');
            return $pdf->download('mat_hang_kinh_doanh_theo_ho_KD-'.$getList['ho_info']->ma_so_ho_kd.'.pdf');
        }
    }

    public function form($id_ho='', $id=''){
        $view = [];
        $view['hoKinhDoanh'] = $this->hoKinhDoanh->get($id_ho);
        // $view['nganhKD'] = $this->nganhKD->all();
        $view['nganhKD'] = $this->nganhKD->get($view['hoKinhDoanh']->id_nganh_kd);
        $view['coSocoSoCungCapCC'] = $this->coSoCungCap->all();
        $view['donViTinh'] = $this->donViTinh->all();
        $view['id_ho'] = $id_ho;
        $view['id'] = $id;
        $view['sap'] = $this->sap->getByColumn('id_ho_kinh_doanh', $id_ho);
        // dd($view['sap']);
        $view['data'] = $this->matHangKinhDoanh->get($id);
        if($id=='')
            return view('admin.danh-sach-mat-hang-kd.form', $view);
        else{
            return view('admin.danh-sach-mat-hang-kd.form', $view);
        }
    }

    public function save(Request $request){
        //dd($request->all());
        $validator = \Validator::make($request->all(), [
            'ten' => 'required',
            'luong_hang_bq_nhap' => 'required',
            'ten_giay_chung_nhan' => 'required',
            'id_ho_kd' => 'required',
            'id_co_so_cc' => 'required',
            'id_don_vi' => 'required',
            'id_nganh_kd' => 'required',
            'id_sap' => 'required',
        ],[
            'ten.required' => 'Tên không được rỗng',
            'luong_hang_bq_nhap.required' => 'Lượng hàng nhập không được rỗng',
            'ten_giay_chung_nhan.required' => 'Tên giấy chứng nhận không được rỗng',
            'id_co_so_cc.required' => 'Cơ sở cung cấp không được rỗng',
            'id_don_vi.required' => 'Đơn vị tính không được rỗng',
            'id_sap.required' => 'Sạp không được rỗng',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $data=$request->all();
            if ($request->hasFile('url_giay_chung_nhan')) {
                $file = $request->url_giay_chung_nhan;

                // //Lấy Tên files
                // echo 'Tên Files: ' . $file->getClientOriginalName();
                // echo '<br/>';
                // //Lấy Đuôi File
                // echo 'Đuôi file: ' . $file->getClientOriginalExtension();
                // echo '<br/>';
                // //Lấy đường dẫn tạm thời của file
                // echo 'Đường dẫn tạm: ' . $file->getRealPath();
                // echo '<br/>';
                // //Lấy kích cỡ của file đơn vị tính theo bytes
                // echo 'Kích cỡ file: ' . $file->getSize();
                // echo '<br/>';
                // //Lấy kiểu file
                // echo 'Kiểu files: ' . $file->getMimeType();
                $file = $request->url_giay_chung_nhan;
                $file->move('upload', $file->getClientOriginalName());
                $data['url_giay_chung_nhan'] = $file->getClientOriginalName();
            }
            $data['ngay_dang_ky'] = Carbon::now();
            if($request->id_sp != ''){
                $this->matHangKinhDoanh->update($data, $request->id_sp);
                set_flash_message('Cập nhật hành công', 'success');
                return redirect()->route('admin.mat_hang_kinh_doanh.list', $request->id_ho_kd); 
            }
            else{
                // dd($data);
                $this->matHangKinhDoanh->save($data);
                set_flash_message('Thêm thành công', 'success');
                return redirect()->route('admin.mat_hang_kinh_doanh.list', $request->id_ho_kd);  
            }
        }
    }
    

    public function delete($id) {
        $result = $this->matHangKinhDoanh->delete($id);
        if ($result) {
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('xóa không thành công');
        }
    }

    
}
