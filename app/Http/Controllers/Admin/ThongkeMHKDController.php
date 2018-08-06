<?php

namespace App\Http\Controllers\Admin;

use Excel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPExcel_Worksheet_PageSetup;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ChoRepositoryInterface;
use App\Repositories\Contracts\ThongkeRepositoryInterface;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use Barryvdh\DomPDF\Facade as PDF;

class ThongkeMHKDController extends Controller
{
    private $cho;
    private $thongke;
    private $nganhKD;
    public function __construct(ChoRepositoryInterface $chorepos,ThongkeRepositoryInterface $thongkeMH,NganhKinhDoanhRepositoryInterface $nganh)
    {
        $this->cho = $chorepos;
        $this->thongke = $thongkeMH;
        $this->nganhKD = $nganh;
    }
    public function index(Request $request){
        // dd($request->all());
        // $day = explode("-",$request->get('day'));
        // $form = trim($day[0]);
        // dd($form);

        $getList = $this->thongke->getKeKhaiMHKD($request->all());


        $view = [];
        $view['listCho'] = $this->cho->all();
        $view['listNganh']  = $this->nganhKD->all();
        $view['getListCho'] = $getList['getListCho'];
        $view['getListNganh'] = $getList['getListNganh'];
        $view['listSoHoKinhDoanh'] = $getList['listSoHoKinhDoanh'];
        $view['getListKeKhai'] = $getList['getListKeKhai'];
        $view['getGiayPhepATTP'] = $getList['getGiayPhepATTP'];
        $view['getSoHoKeKhai'] = $getList['getSoHoKeKhai'];
        session()->flashInput($request->input());
        return view('admin.thong-ke.ke-khai-mhkd-tai-cho',$view);


    }


    public function export(Request $request)
    {

        $getList = $this->thongke->getKeKhaiMHKD($request->all());
//        dd($getList);
        $export = Excel::create('KekhaiMHKD_'.Carbon::now()->format('Y-m-d'), function($excel) use($getList) {
            $excel->sheet('New sheet', function($sheet) use($getList) {
                $sheet->setorientation('landscape');
                $sheet->setpaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
                $sheet->loadView('admin.thong-ke.export.ke-khai-mdkd',[
                'getListCho' => $getList['getListCho'],
                'getListNganh' => $getList['getListNganh'],
                'listSoHoKinhDoanh' => $getList['listSoHoKinhDoanh'],
                'getListKeKhai' => $getList['getListKeKhai'],
                'getGiayPhepATTP' => $getList['getGiayPhepATTP'],
                'getSoHoKeKhai' => $getList['getSoHoKeKhai']
                ]);
                $code = \PHPExcel_Cell::stringFromColumnIndex($getList['getListCho'] != null ? $getList['getListCho']->count() : 1).($getList['getListNganh'] != null ? $getList['getListNganh']->count()+14 : 1);
                $sheet->setBorder('A6:'.$code,'thin');

            });
        })->store('xls')->export('xls');;
    }
    public function exportPDF(Request $request)
    {
        $getList = $this->thongke->getKeKhaiMHKD($request->all());
        $pdf = PDF::loadView('admin.thong-ke.export.pdf.ke-khai-mdkd', [
            'getListCho' => $getList['getListCho'],
            'getListNganh' => $getList['getListNganh'],
            'listSoHoKinhDoanh' => $getList['listSoHoKinhDoanh'],
            'getListKeKhai' => $getList['getListKeKhai'],
            'getGiayPhepATTP' => $getList['getGiayPhepATTP'],
            'getSoHoKeKhai' => $getList['getSoHoKeKhai']
            ])->setPaper('a3', 'landscape');
        return $pdf->download('Ke khai MHKD_'.Carbon::now().'.pdf');
    }


}
