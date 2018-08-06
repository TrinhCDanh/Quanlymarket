<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\ChoRepositoryInterface;
use App\Repositories\Contracts\SapRepositoryInterface;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\MatHangKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\LogHoKinhDoanhRepositoryInterface;
use PHPExcel_Worksheet_PageSetup;
use Excel;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use function MongoDB\BSON\toJSON;
use DB;

class HoKinhDoanhController extends Controller
{
    private $hoKinhDoanh;
    private $cho;
    private $sap;
    private $nganhKinhDoanh;
    private $matHangKD;
    private $logHoKinhDoanhRepository;

    public function __construct(HoKinhDoanhRepositoryInterface $hoKinhDoanhRepository,
                                ChoRepositoryInterface $choRepository,
                                SapRepositoryInterface $sapRepository,
                                NganhKinhDoanhRepositoryInterface $nganhKinhDoanhRepository,
                                MatHangKinhDoanhRepositoryInterface $matHangKinhDoanh,
                                LogHoKinhDoanhRepositoryInterface $logHoKinhDoanhRepository)
    {
        $this->hoKinhDoanh = $hoKinhDoanhRepository;
        $this->cho = $choRepository;
        $this->sap = $sapRepository;
        $this->nganhKinhDoanh = $nganhKinhDoanhRepository;
        $this->logHoKinhDoanh = $logHoKinhDoanhRepository;


    }

    public function add()
    {
        $view = [];
        $view['list'] = $this->cho->all();
        $view['list_nganh'] = $this->nganhKinhDoanh->all();
        $view['list_ho_kd'] = $this->hoKinhDoanh->all();
        return view('admin.danh-sach-ho-kd.add', $view);
    }

    public function getAll(Request $request)
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
        //dd($query);
        $list = $this->hoKinhDoanh->getListHoKinhDoanh($query,$perPage, $currentPage);
        $view['list'] = $list['data'];
        $view['paginate'] = $list['paginate'];
        //dd($view['paginate']);
        $view['data_cho'] = $this->cho->all();
        $view['list_nganh'] = $this->nganhKinhDoanh->all();
        $view['start_order'] = $start_order;
        $view['total'] = $list['total'];
        $view['countPerPage'] = count($view['list']);
        return view('admin.danh-sach-ho-kd.list', $view);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $sap = $this->sap;
        $validator = \Validator::make($request->all(), [
            'sap' => 'required',
            'ma_so_ho_kd' => 'required|unique:ho_kinh_doanh,ma_so_ho_kd',
            'ten_ho_kd' => 'required',
            'so_lan_thay_doi' => 'required',
            'ngay_thay_doi' => 'required',
            'ngay_dang_ki_1st' => 'required',
            'id_cho' => 'required',
            'id_nganh_kd' => 'required',
            'ho_chu_ho_kd' => 'required',
            'ten_chu_ho_kd' => 'required',
            'loai_giay_to' => 'required',
            'ma_so_giay_to' => 'required|unique:ho_kinh_doanh,ma_so_giay_to',
            'von_kd' => 'required',
        ]);
        if ($validator->fails()) {
            $data_errors = $validator->errors();
            $array = [];
            foreach ($data_errors->messages() as $key => $error) {
                $array[] = ['key' => $key, 'mess' => $error];

            }
            return $this->dataError('errors', $array);
            //return redirect()->back()->withErrors($validator);
        } else {
            //dat bien ho kinh doanh
            if ($data['ngay_thay_doi'] >= $data['ngay_dang_ki_1st']) {
                $saveHoKinhDoanh = $this->hoKinhDoanh->save($data);
                //dd($saveHoKinhDoanh);
            } else {
                //Session::flash('message', 'aaaaa');
                return redirect()->back()->with('message', 'Ngày thay đổi phải lớn hơn ngày đăng ký');
            }
            $id_sap = $data['sap'];
            if ($saveHoKinhDoanh) {
                $id_ho_kd = $saveHoKinhDoanh->id;
                foreach ($id_sap as $item) {
                    $list = $sap->get($item);
                    $update_sap = $this->sap->getByColumn('id', $list->id);
                    foreach ($update_sap as $item_sap) {
                        $item_sap->id_ho_kinh_doanh = $id_ho_kd;
                    }

                    $item_sap->save();

                }
            }
            $data['id_ho_kinh_doanh'] = $saveHoKinhDoanh->id;
            if ($saveHoKinhDoanh) {
                //dd($data);
                $this->logHoKinhDoanh->save($data);
            }
            return $this->dataSuccess('Success');
        }

    }

    public function deleteHoKinhDoanh($id)
    {
        $result = $this->hoKinhDoanh->deleteHoKinhDoanh($id);
        $ma_so_ho_kd = $result->where('id', $id)->get();
       foreach ($ma_so_ho_kd as $item)
       {
           $ma_so_ho_kd = $item->ma_so_ho_kd;
           if ($result) {
               return redirect()->to(route('admin.ho_kinh_doanh.list'))->with(['message'=>"Xóa thành công mã số hộ kinh doanh $ma_so_ho_kd"]);
           } else {
               return redirect()->back()->withErrors('xóa không thành công');
           }
       }

    }

    public function show($id)
    {
        $data = $this->hoKinhDoanh->get($id);
        $view['data'] = $data;
        $view['list_cho'] = $this->cho->all();
        $view['list_sap'] = $this->sap->all();
        $view['list_nganh'] = $this->nganhKinhDoanh->all();
        $view['list_id_sap_ho_kinh_doanh'] = array_pluck($data->getSap->ToArray(), 'id');
        return view('admin.danh-sach-ho-kd.show', $view);
    }

    public function edit($id)
    {
        $data = $this->hoKinhDoanh->get($id);
        $view['data'] = $data;
        $view['list_cho'] = $this->cho->all();
        $view['list_sap'] = $this->sap->all();
        $view['list_nganh'] = $this->nganhKinhDoanh->all();
        $view['list_id_sap_ho_kinh_doanh'] = array_pluck($data->getSap->ToArray(), 'id');
        return view('admin.danh-sach-ho-kd.edit', $view);
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $list_sap = $this->sap->all();
        $list_sap = $list_sap->where('delete_at', 0);
        $sap = $this->sap;
        $validator = \Validator::make($request->all(), [
            'ma_so_ho_kd' => 'required',
            'ten_ho_kd' => 'required',
            'so_lan_thay_doi' => 'required',
            'ngay_dang_ki_1st' => 'required',
            'ngay_thay_doi' => 'required',
            'id_cho' => 'required',
            'id_nganh_kd' => 'required',
            'ho_chu_ho_kd' => 'required',
            'ten_chu_ho_kd' => 'required',
            'loai_giay_to' => 'required',
            'ma_so_giay_to' => 'required',
            'sap' => 'required',
            'von_kd' => 'required',
        ]);
        //dd($validator);
        if ($validator->fails()) {
            $data_errors = $validator->errors();
            $array = [];
            foreach ($data_errors->messages() as $key => $error) {
                $array[] = ['key' => $key, 'mess' => $error];

            }
            return $this->dataError('errors', $array);
            //return redirect()->back()->withErrors($validator);
        } else {
            $data = $request->all();
            $data['id_ho_kinh_doanh'] = $id;
            //dd($data);
            $id_sap = $data['sap'];
            $saveHoKinhDoanh = $this->hoKinhDoanh->update($data, $id);

            if ($saveHoKinhDoanh) {
                DB::table('sap')->where('id_ho_kinh_doanh', $id)->update(['id_ho_kinh_doanh' => null]);
                if (isset($id_sap)) {
                    foreach ($id_sap as $item) {
                        $list = $sap->get($item);
                        $update_sap = $this->sap->getByColumn('id', $list->id);
                        foreach ($update_sap as $item_sap) {
                            $item_sap->id_ho_kinh_doanh = $id;
                        }

                        $item_sap->save();
                    }
                } else {
                    return redirect()->back()->with('message', 'Sạp không được để trống');
                }

            }
            if ($saveHoKinhDoanh) {
                $log_ho_kinh_doanh = $this->logHoKinhDoanh->all();
                $log_ho_kinh_doanh = $log_ho_kinh_doanh->where('id_ho_kinh_doanh', $id)->toArray();
                foreach ($log_ho_kinh_doanh as $item) {

                    if (empty($log_ho_kinh_doanh)) {
                        $savelog = $this->logHoKinhDoanh->save($data);

                    } else if ($log_ho_kinh_doanh && $item['ngay_thay_doi'] == $data['ngay_thay_doi']) {
                        $savelog = $this->logHoKinhDoanh->update($data, $item['id']);
                    } else {
                        $savelog = $this->logHoKinhDoanh->save($data);
                    }
                }

            }

            return $this->dataSuccess('Success');
        }
    }

    public function export(Request $request)
    {
        $query = $request->all();
        if($query != null)
        {
            $getList = $this->hoKinhDoanh->getListHoKinhDoanh($query);
            ini_set('precision', 18);
            $export = Excel::create('Danh Sách Hộ Kinh Doanh_' . Carbon::now()->format('Y-m-d'), function ($excel) use ($getList) {
                $excel->sheet('New sheet', function ($sheet) use ($getList) {
                    $sheet->setColumnFormat(array('A'=>'0'));
                    $sheet->setorientation('landscape');
                    $sheet->setpaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
                    $sheet->loadView('admin.danh-sach-ho-kd.export.list-export-ho-kd',[
                        'list' =>$getList['data'],
                    ]);

                });
            })->store('xls')->export('xls');
        }
        else{
            $getList = $this->hoKinhDoanh->exportexcel($request->all());
            ini_set('precision', 18);
            $export = Excel::create('Danh Sách Hộ Kinh Doanh_' . Carbon::now()->format('Y-m-d'), function ($excel) use ($getList) {
                $excel->sheet('New sheet', function ($sheet) use ($getList) {
                    $sheet->setColumnFormat(array('A'=>'0'));
                    $sheet->setorientation('landscape');
                    $sheet->setpaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
                    $sheet->loadView('admin.danh-sach-ho-kd.export.list-export-ho-kd',[
                        'list' =>$getList['data'],
                    ]);

                });
            })->store('xls')->export('xls');
        }

    }
    public function exportPDF(Request $request)
    {
        $query = $request->all();
        if($query)
        {
            $getList = $this->hoKinhDoanh->getListHoKinhDoanh($query);
            $pdf = PDF::loadView('admin.danh-sach-ho-kd.export-pdf.list-export-pdf-ho-kd', [
                'list'=>$getList['data']
            ])->setPaper('a3', 'landscape');
            return $pdf->download('Danh Sách Hộ Kinh Doanh_'.Carbon::now()->format('Y-m-d').'.pdf');
        }
        else{
            $getList = $this->hoKinhDoanh->exportexcel($request->all());
            $pdf = PDF::loadView('admin.danh-sach-ho-kd.export-pdf.list-export-pdf-ho-kd', [
                'list'=>$getList['data']
            ])->setPaper('a3', 'landscape');
            return $pdf->download('Danh Sách Hộ Kinh Doanh_'.Carbon::now()->format('Y-m-d').'.pdf');
        }
    }
}
