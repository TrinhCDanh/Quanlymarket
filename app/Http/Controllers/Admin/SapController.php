<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\SapRepositoryInterface;
use App\Repositories\Contracts\ChoRepositoryInterface;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SapController extends Controller
{
    //
    private $sap;
    private $cho;
    private $hoKinhDoanh;


    public function __construct(SapRepositoryInterface $sapRepository, 
                                ChoRepositoryInterface $choRepository,
                                HoKinhDoanhRepositoryInterface $hoKinhDoanhRepository)
    {
        $this->sap = $sapRepository;
        $this->cho = $choRepository;
        $this->hoKinhDoanh = $hoKinhDoanhRepository;
    }

    public function index(Request $request)
    {
        //Nhân biến $query
        $query = [];
        $query = $request->all();
        // $query['searchValue'] = $request->get('searchValue') !== null ? $request->get('searchValue') : '';
        // $query['searchOption'] = $request->get('searchOption') !== null ? $request->get('searchOption') : '';
        // $query['id_cho'] = $request->get('id_cho') !== null ? $request->get('id_cho') : '';

        $view = [];
        //lọc dữ liệu 10/20/30
        if(isset($_GET['paginate']))
        {
            $paginate = $_GET['paginate'];
        }else{
        $paginate = 10;
        }
        $currentPage = $request->get('page') ? $request->get('page') : 1;
        //Số thứ tự
        $start_order = ($currentPage - 1) * $paginate + 1;

        $list = $this->sap->getListSap($paginate,15,$query);
        $view['cho'] = $this->cho->all();
        $view['data'] = $list['data'];
        $view['total'] = $list['total'];
        $view['paginate'] = $list['paginate'];
        $view['start_order'] = $start_order;
        //Đếm kết quả
        $view['count'] = $view['total'];
        $view['countPerPage'] = count($view['data']);

        return view('admin.sap.list', $view);
    }

    public function create()
    {
        $view['cho'] = $this->cho->all();
        return view('admin.sap.add', $view);
    }

    public function store(Request $request)
    {
        //
        $validator = \Validator::make($request->all(), [
            'ma_so_sap' => 'unique:sap,ma_so_sap',
            'ten' => 'required',
            //'id_ho_kinh_doanh' => 'required',
            'id_cho' => 'required'
         
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            //save to dan pho
           
           $data = $request->all();

            $data['delete_at'] = 0;
            $saveSap = $this->sap->save($data);
            if ($saveSap) {
                $maSoSap = $saveSap->ma_so_sap;
                $ten = $saveSap->ten;
                $idCho= $saveSap->id_cho;
            }
          
            return redirect()->to(route('admin.sap.list'))->with('message', 'Thêm thành công');
        }
    }

    public function show($id)
    {
        //
        $view['cho'] = $this->cho->all();
        $view['data'] = $this->sap->get($id);
        return view('admin.sap.show',$view);
    }

    public function edit($id)
    {
        $view['cho'] = $this->cho->all();
        $view['hoKinhDoanh'] = $this->hoKinhDoanh->all();
        //dd($view['hoKinhDoanh']);
        $view['data'] = $this->sap->get($id);
        return view('admin.sap.edit', $view);
    }

    public function update(Request $request, $id)
    {
        //
        $validator = \Validator::make($request->all(), [
            //'ma_so_sap' => 'unique:sap,ma_so_sap',
            'ten' => 'required',
            //'id_ho_kinh_doanh' => 'required',
            'id_cho' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            
            $data = $request->all();
            $sap = $this->sap->update($data,$id);
          
            return redirect()->to(route('admin.sap.list'))->with('message', 'Sửa thành công');
        }
    }

    public function deleteSap($id)
    {
        $result = $this->sap->deleteSap($id);
        if ($result) {
            return redirect()->to(route('admin.sap.list'))->with('message', 'Xóa thành công');
        } else {
            return redirect()->back()->withErrors('xóa không thành công');
        }

    }

    public function deleteHoKinhDoanh($id)
    {
        $result = $this->sap->deleteHoKinhDoanh($id);
        if ($result) {
            return redirect()->to(route('admin.sap.edit',['id'=>$id]));
        } else {
            return redirect()->back()->withErrors('xóa không thành công');
        }

    }
}
