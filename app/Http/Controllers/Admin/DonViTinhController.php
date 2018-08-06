<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\DonViTinhRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class DonViTinhController extends Controller
{
    //
    private $donViTinh;


    public function __construct(DonViTinhRepositoryInterface $donViTinhRepository)
    {
        $this->donViTinh = $donViTinhRepository;
    }

    public function index(Request $request)
    {
        //Nhân biến $query
        $query = [];
        $query['searchValue'] = $request->get('searchValue') !== null ? $request->get('searchValue') : '';
        $query['searchOption'] = $request->get('searchOption') !== null ? $request->get('searchOption') : '';


        $view = [];
        if(isset($_GET['paginate']))
        {
            $paginate = $_GET['paginate'];
        }else{
        $paginate = 10;
        }
        $currentPage = $request->get('page') ? $request->get('page') : 1;
        //Số thứ tự
        $start_order = ($currentPage - 1) * $paginate + 1;
        $list = $this->donViTinh->getListDonViTinh($paginate,$currentPage,$query);
        $view['data'] = $list['data'];
        $view['paginate'] = $list['paginate'];
        $view['start_order'] = $start_order;
        //Đếm kết quả
        $view['count'] = $view['paginate'];
        $view['countPerPage'] = count($view['data']);

        return view('admin.don-vi-tinh.list', $view);
    }

    public function create()
    {
        return view('admin.don-vi-tinh.add');
    }

    public function store(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [
            'ten' => 'required'
         
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
           $data = $request->all();
            $saveDonViTinh = $this->donViTinh->save($data);
            return redirect()->to(route('admin.don-vi-tinh.list'));
        }
    }

    public function show($id)
    {
        $view['data'] = $this->donViTinh->get($id);
        return view('admin.don-vi-tinh.show',$view);
    }

    public function edit($id)
    {
        $view['data'] = $this->donViTinh->get($id);
        return view('admin.don-vi-tinh.edit', $view);
    }

    public function update(Request $request, $id)
    {
        
        $validator = \Validator::make($request->all(), [
            'ten' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            
            $data = $request->all();
            $sap = $this->donViTinh->update($data,$id);
          
            return redirect()->to(route('admin.don-vi-tinh.list'));
        }
    }

    public function delete($id)
    {
        $result = $this->donViTinh->delete($id);
        if ($result) {
            return redirect()->to(route('admin.don-vi-tinh.list'));
        } else {
            return redirect()->back()->withErrors('xóa không thành công');
        }

    }
}
