<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\ChoRepositoryInterface;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\PhuongRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class THKHTheoNhomNganhController extends Controller
{
    //
    private $hoKinhDoanh;
    private $phuong;
    private $cho;
    private $nganhNgheKinhDoanh;

    public function __construct(
        HoKinhDoanhRepositoryInterface $hoKinhDoanhRepository,
        PhuongRepositoryInterface $phuongRepository,
        ChoRepositoryInterface $choRepository,
        NganhKinhDoanhRepositoryInterface $nganhKinhDoanhRepository
    )
    {
        $this->hoKinhDoanh = $hoKinhDoanhRepository;
        $this->phuong = $phuongRepository;
        $this->cho = $choRepository;
        $this->nganhNgheKinhDoanh = $nganhKinhDoanhRepository;
    }

    public function getAll(Request $request)
    {
        $currentPage = $request->get('page') ? $request->get('page') : 1;
        $perPage = 15;
        $start_order = ($currentPage - 1) * $perPage + 1;
        $query = $request->all();

        $view = [];
        $list = $this->hoKinhDoanh->getListThongKeTheoNhomNganh($perPage, $currentPage, $query);
        // dd($list);
        $view['list'] = $list['data'];
        $view['paginate'] = $list['paginate'];
        $view['listPhuong'] = $this->phuong->all();
        $view['listCho'] = $this->cho->all();
        $view['listNganhKinhDoanh'] = $this->nganhNgheKinhDoanh->all();
        $view['start_order'] = $start_order;
        return view('admin.thong-ke.tinh-hinh-ke-khai-theo-nhom-nganh', $view);
    }
}
