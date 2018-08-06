<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MatHangKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\SapRepositoryInterface;
use App\Repositories\Contracts\ChoRepositoryInterface;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\ThongkeRepositoryInterface;
use PHPExcel_Worksheet_PageSetup;
use Excel;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class ThongkeController extends Controller
{
    private $hoKinhDoanh;
    private $cho;
    private $sap;
    private $nganhKinhDoanh;
    private $matHangKD;
    private $thongKe;

    public function __construct(HoKinhDoanhRepositoryInterface $hoKinhDoanhRepository,
                                ChoRepositoryInterface $choRepository,
                                SapRepositoryInterface $sapRepository,
                                NganhKinhDoanhRepositoryInterface $nganhKinhDoanhRepository,
                                MatHangKinhDoanhRepositoryInterface $matHangKinhDoanhRepository,
                                ThongkeRepositoryInterface $thongKeRepository)
    {
        $this->hoKinhDoanh = $hoKinhDoanhRepository;
        $this->cho = $choRepository;
        $this->sap = $sapRepository;
        $this->nganhKinhDoanh = $nganhKinhDoanhRepository;
        $this->matHangKD = $matHangKinhDoanhRepository;
        $this->thongKe = $thongKeRepository;
    }

    public function index(Request $request)
    {
        $currentPage = $request->get('page') ? $request->get('page') : 1;
        if (isset($_GET['paginate'])) {
            $perPage = $_GET['paginate'];
        } else {
            $perPage = 10;
        }
        $start_order = ($currentPage - 1) * $perPage + 1;
        $query = $request->all();
        $view = [];
        $list = $this->thongKe->getKeKhaiMHKDTruyenThong($query, $perPage, $currentPage );
        $view['list'] = $list['data'];
        $view['data_search'] = $list['data_search'];
        $view['data_filter'] = $list['data_filler'];
        $view['data_sap'] = $list['data_sap'];
        $view['data_cho'] = $this->cho->all();
        $view['list_nganh'] = $this->nganhKinhDoanh->all();
        $view['start_order'] = $start_order;
        //dd($view);
        return view('admin.thong-ke.ke-khai-mhkd-tai-cho-truyen-thong', $view);
    }


    public function exportthongkett(Request $request)
    {
        $query = $request->all();
        $getList = $this->thongKe->getKeKhaiMHKDTruyenThong($query);
        //dd($getList['data_filler']);
        $export = Excel::create('mat_hang_kinh_doanh_tai_cho_truyen_thong_'. Carbon::now()->format('Y-m-d'), function ($excel) use ($getList) {
            $excel->sheet('New sheet', function ($sheet) use ($getList) {
                $sheet->setorientation('landscape');
                $sheet->setpaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
                $sheet->loadView('admin.thong-ke.export.ke-khai-mhkd-tai-cho-tt',[
                    'list' =>$getList['data'],
                    'data_filter'=>$getList['data_filler'],
                    'data_search'=>$getList['data_search']
                ]);
                //dd($getList['data_filler']);
            });
        })->store('xls')->export('xls');
    }
    public function exportthongkePDF(Request $request)
    {
        $query = $request->all();
        $getList = $this->thongKe->getKeKhaiMHKDTruyenThong($query);
        $pdf = PDF::loadView('admin.thong-ke.export.pdf.ke-khai-mhkd-tai-cho-tt-pdf', [
            'list' =>$getList['data'],
            'data_filter'=>$getList['data_filler'],
            'data_search'=>$getList['data_search']
        ])->setPaper('a3', 'landscape');
        return $pdf->download('mat_hang_kinh_doanh_tai_cho_truyen_thong_'.Carbon::now()->format('Y-m-d').'.pdf');
    }
}
