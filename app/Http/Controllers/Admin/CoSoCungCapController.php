<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\CoSoCungCapRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CoSoCungCapController extends Controller
{
    //
    private $coSoCungCap;
    public function __construct(CoSoCungCapRepositoryInterface $coSoCungCapRepository)
    {
        $this->coSoCungCap = $coSoCungCapRepository;
    }

    public function index(Request $request)
    {
        //Nhân biến $query
        $query = [];
        $query = $request->all();
        // $query['searchValue'] = $request->get('searchValue') !== null ? $request->get('searchValue') : '';
        // $query['searchOption'] = $request->get('searchOption') !== null ? $request->get('searchOption') : '';

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

        $list = $this->coSoCungCap->getListCoSoCungCap($paginate,$currentPage,$query);
        $view['data'] = $list['data'];
        $view['total'] = $list['total'];
        $view['paginate'] = $list['paginate'];
        $view['start_order'] = $start_order;
        //Đếm kết quả
        $view['count'] = $view['total'];
        $view['countPerPage'] = count($view['data']);

        return view('admin.co-so-cung-cap.list', $view);
    }

    public function create()
    {
        return view('admin.co-so-cung-cap.add');
    }

    public function store(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [
            'ten' => 'required',
            //'id_ho_kinh_doanh' => 'required',
            'sdt' => 'required',
            'dia_chi' => 'required'
         
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
           $data = $request->all();
            $saveCoSoCungCap = $this->coSoCungCap->save($data);
            return redirect()->to(route('admin.co_so_cung_cap.list'))->with('message', 'Thêm thành công');
        }
    }

    public function show($id)
    {
        $view['data'] = $this->coSoCungCap->get($id);
        return view('admin.co-so-cung-cap.show',$view);
    }

    public function edit($id)
    {
        $view['data'] = $this->coSoCungCap->get($id);
        return view('admin.co-so-cung-cap.edit', $view);
    }

    public function update(Request $request, $id)
    {
        
        $validator = \Validator::make($request->all(), [
            'ten' => 'required',
            'sdt' =>'required',
            'dia_chi' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            
            $data = $request->all();
            $sap = $this->coSoCungCap->update($data,$id);
          
            return redirect()->to(route('admin.co_so_cung_cap.list'))->with('message', 'Sửa thành công');
        }
    }

    public function delete($id)
    {
        $result = $this->coSoCungCap->delete($id);
        if ($result) {
            return redirect()->to(route('admin.co_so_cung_cap.list'))->with('message', 'Xóa thành công');
        } else {
            return redirect()->back()->withErrors('xóa không thành công');
        }

    }
}
