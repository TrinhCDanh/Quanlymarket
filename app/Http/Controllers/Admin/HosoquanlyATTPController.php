<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\ChoRepositoryInterface;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\PhuongRepositoryInterface;
use App\Repositories\Contracts\MatHangKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\ATTPRepositoryInterface;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use PHPExcel_Worksheet_PageSetup;

class HosoquanlyATTPController extends Controller
{
  private $hoKinhDoanh;
  private $phuong;
  private $cho;
  private $nganhNgheKinhDoanh;
  private $matHangKd;
  private $hosoATTP;
  public function __construct(
      HoKinhDoanhRepositoryInterface $hoKinhDoanhRepository,
      PhuongRepositoryInterface $phuongRepository,
      ChoRepositoryInterface $choRepository,
      NganhKinhDoanhRepositoryInterface $nganhKinhDoanhRepository,
      MatHangKinhDoanhRepositoryInterface $matHangKinhDoanh,
      ATTPRepositoryInterface $ATTPRepository
  )
  {
        $this->hoKinhDoanh = $hoKinhDoanhRepository;
        $this->phuong = $phuongRepository;
        $this->cho = $choRepository;
        $this->nganhNgheKinhDoanh = $nganhKinhDoanhRepository;
        $this->matHangKD = $matHangKinhDoanh;
        $this->hosoATTP = $ATTPRepository;
  }

  public function index(Request $request)
  {

//      dd($request->get('cho'));
    if($request->has('paginate') && is_numeric($request->get('paginate')))
    {
        
        if($request->get('paginate') == -1)
        {
            $perPage = $this->hoKinhDoanh->all()->count();
            
        }   
        else
            $perPage = $request->get('paginate');
    }
    else
    {
        
        $perPage = 10;
    }
    
    $view=[];
    $currentPage = $request->has('page') ? $request->get('page') : 1;
    $query = $request->all();
    $list = $this->hosoATTP->getDanhSachATTP(10,$query);
//     dd($list);
    $view['cho']  = $this->cho->all();
    $view['mathang'] = $this->nganhNgheKinhDoanh->all();
    $view['list'] = $list;
    Input::flash($request->all());
    return view('admin.thong-ke.quan-ly-ho-so-ATTP', $view);
    }

    public function getDanhSachATTP()
    {

    }

    public function search(Request $request)
    {
        $view = [];
        $list = $this->hoKinhDoanh->getListThongKeTheoNhomNganh(null, null, $request->all());
        $view['list'] = $list['data'];
        $view['paginate'] = $list['paginate'];
    
        return view('admin.thong-ke.quan-ly-ho-so-ATTP', $view);

    }

    public function export(Request $request)
    {
       
        if($request->has('cho'))
        {
            if($request->get('cho') != '')
            {
                
                $list = $this->hosoATTP->getDanhSachATTP(10,$request->all());

                
                $export = Excel::create('ATTP_'.Carbon::now()->format('Y-m-d'), function($excel) use($list) {
                    $excel->sheet('New sheet', function($sheet) use ($list) {
                        $sheet->setorientation('landscape');
                        $sheet->setpaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
                        $sheet->loadView('admin.thong-ke.export.quan-ly-ho-so-ATTP',[
                        'list' => $list
                        ]);
                        $code = \PHPExcel_Cell::stringFromColumnIndex(11).(count($list)+6);
                        $sheet->setBorder('A6:'.$code,'thin');
                
                    });
                    
                
                })->store('xls')->export('xls');;
            }
            else
            {
                return redirect()->to(route('admin.quanly.hoso.attp'))->with(['error'=> 'Bạn phải chọn chợ để xuất báo cáo']);
            }
        }
    }

}
