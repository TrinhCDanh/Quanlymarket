<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class NganhKinhDoanhController extends Controller
{
    //
    private $nganhKinhDoanh;


    public function __construct(NganhKinhDoanhRepositoryInterface $nganhKinhDoanhRepository)
    {
        $this->nganhKinhDoanh = $nganhKinhDoanhRepository;
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

        $list = $this->nganhKinhDoanh->getListNganhKinhDoanh($paginate,15,$query);
        $view['data'] = $list['data'];
        $view['total'] = $list['total'];
        $view['paginate'] = $list['paginate'];
        $view['start_order'] = $start_order;
        //Đếm kết quả
        $view['count'] = $view['total'];
        $view['countPerPage'] = count($view['data']);

        return view('admin.nganh-kinh-doanh.list', $view);
    }

    public function create()
    {
        return view('admin.nganh-kinh-doanh.add');
    }

    public function store(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [
            'ten_nganh' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
           $data = $request->all();
            $saveNganhKinhDoanh = $this->nganhKinhDoanh->save($data);
            return redirect()->to(route('admin.nganh_kinh_doanh.list'));
        }
    }

    public function show($id)
    {
        $view['data'] = $this->nganhKinhDoanh->get($id);
        return view('admin.nganh-kinh-doanh.show',$view);
    }

    public function edit($id)
    {
        $view['data'] = $this->nganhKinhDoanh->get($id);
        return view('admin.nganh-kinh-doanh.edit', $view);
    }

    public function update(Request $request, $id)
    {
        
        $validator = \Validator::make($request->all(), [
            'ten_nganh' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            
            $data = $request->all();
            $nganhKinhDoanh = $this->nganhKinhDoanh->update($data,$id);
          
            return redirect()->to(route('admin.nganh_kinh_doanh.list'));
        }
    }

    public function delete($id)
    {
        $result = $this->nganhKinhDoanh->delete($id);
        if ($result) {
            return redirect()->to(route('admin.nganh_kinh_doanh.list'));
        } else {
            return redirect()->back()->withErrors('xóa không thành công');
        }
    }
}
