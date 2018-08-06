<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\ChoRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;

class ChoController extends Controller
{
    //
    private $cho;
    private $nganhKinhDoanh;
    private $hoKinhDoanh;
    public function __construct(ChoRepositoryInterface $choRepository , NganhKinhDoanhRepositoryInterface $nganhKinhDoanhRepository, HoKinhDoanhRepositoryInterface $hoKinhDoanhRepository)
    {
        $this->cho = $choRepository;
        $this->nganhKinhDoanh = $nganhKinhDoanhRepository;
        $this->hoKinhDoanh = $hoKinhDoanhRepository;
    }

    public function getAll(Request $request){

        $perPage = 10;
        if($request->has('paginate') && is_numeric($request->get('paginate')))
        {
            
            if($request->input('paginate') == -1)
            {
                
                $perPage = $this->cho->all()->count();
                
            }
            else
                $perPage = $request->get('paginate');
        }
        
        $list = $this->cho->getListCho($request,$perPage);
        $view['data'] = $list['data'];
        $view['all'] = $this->cho->all()->count();
        $view['paginate']  = $list['paginate'];
        session()->flashInput($request->input());
        return view('admin.cho.list',$view);
    }





    public function edit(Request $request,$id = null)
    {
        if(isset($id))
        {
            $data = $this->cho->get($id);
            if($data == null)
            {
                return back();
            }
            return view('admin.cho.edit',compact('id','data'));
        }
        else
        {
            return view('admin.cho.edit',compact('id'));
        }
        
    }

    public function update(Request $request,$id = null)
    {
        if($id != null)
        {
            $request->validate(['ten' => 'required|unique:cho,ten,'.$id,
                'dia_chi' => 'required'
               ],
                ['ten.required' => ':attribute không được bỏ trống',
                    'ten.unique' => ':attribute đã tồn tại',
                'dia_chi.required' => ':attribute không được bỏ trống'],
                ['ten' => 'Tên chợ', 'dia_chi' => 'Địa chỉ chợ'
                   ]);
            $result = $this->cho->update($request->all(),$id);
            if($result)
            {
                return redirect()->route('admin.cho.list')->withInput()->with(['message'=>'Cập nhật thành công']);
            }
            else
            {
                return back()->withInput()->with(['message'=>'Cập nhật thất bại']);
            }
        }
        else
        {
            $request->validate(['ten' => 'required|unique:cho,ten',
                                'dia_chi' => 'required'],
                                ['ten.required' => ':attribute không được bỏ trống',
                                'dia_chi.required' => ':attribute không được bỏ trống',
                                'ten.unique' => ':attribute đã tồn tại'],
                                ['ten' => 'Tên chợ',
                                'dia_chi' => 'Địa chỉ chợ']);
            $result = $this->cho->save($request->all());
            if($result)
            {
                return redirect()->route('admin.cho.list')->withInput()->with(['message'=>'Tạo chợ thành công']);
            }
            else
            {
                return back()->withInput()->with(['error'=>'Tạo thất bại']);
            }
        }
        
    }

    public function delete($id)
    {

        $tenCho = $this->cho->getTenCho($id)->first()->ten;
        if($this->hoKinhDoanh->getListByColumn('id_cho',$id)->count() <= 0)
        {
            $result = $this->cho->delete($id);

            if($result)
            {
                return redirect()->route('admin.cho.list')->with(['message'=>'Xóa '.$tenCho.' thành công']);
            }
            else
            {
                return back()->with(['message'=>'Xóa thất bại']);
            }
        }
        else
        {
            return back()->with(['error'=>'Không thể xóa chợ vì đã có hộ kinh doanh đang hoạt động!']);
        }

    }
}
