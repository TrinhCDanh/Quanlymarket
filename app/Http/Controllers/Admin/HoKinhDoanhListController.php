<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use function MongoDB\BSON\toJSON;

class HoKinhDoanhListController extends Controller
{
    private $hoKinhDoanh;
    private $matHangKD;
    public function __construct(HoKinhDoanhRepositoryInterface $hoKinhDoanhRepository)
    {
        $this->hoKinhDoanh = $hoKinhDoanhRepository;
    }

    public function index(){
        $view = [];
        $view['list'] = $this->hoKinhDoanh->paginate(15);
        return view('admin.ho-kinh-doanh.list', $view);
    }
    
}
