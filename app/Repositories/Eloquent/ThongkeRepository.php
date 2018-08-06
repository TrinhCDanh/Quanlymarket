<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ThongkeRepositoryInterface;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\MatHangKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\SapRepositoryInterface;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\LogHoKinhDoanhRepositoryInterface;
use App\Models\Cho;
use App\Models\HoKinhDoanh;
use App\Models\NganhKinhDoanh;
use App\Models\DanhSachMatHangKd;
use App\Models\LogHoKinhDoanh;
class ThongkeRepository implements ThongkeRepositoryInterface
{
    private $cho;
    private $hokindoanh;
    private $nganhkinhdoanh;
    private $sap;
    private $dsmhkd;
    private $logHoKinhDoanh;
    public function __construct(SapRepositoryInterface $sapRepository,
                                HoKinhDoanhRepositoryInterface $hoKinhDoanhRepository,
                                MatHangKinhDoanhRepositoryInterface $matHangKinhDoanhRepository,
                                NganhKinhDoanhRepositoryInterface $nganhKinhDoanhRepository,LogHoKinhDoanhRepositoryInterface $logHoKinhDoanhRepository)
    {

        $this->hoKinhDoanh = new HoKinhDoanh();
        $this->sap = $sapRepository;
        $this->cho = new Cho();
        $this->hokinhdoanh = new HokinhDoanh();
        $this->logHoKinhDoanh = new LogHoKinhDoanh();
        $this->nganhkinhdoanh = new NganhKinhDoanh();
        $this->dsmhkd = $matHangKinhDoanhRepository;
        $this->dsMHKD = new DanhSachMatHangKd();
//        $this->nganhkinhdoanh = $nganhKinhDoanhRepository;
//        $this->dsmhkd = $matHangKinhDoanhRepository;
        $this->sap = $sapRepository;
    }


    public function getListSoHoKinhDoanh($option = null)
    {
        $result = array();
        if(isset($option['cho']) && !empty($option['cho']))
        {
            $listcho = $this->cho->where('id',$option['cho'])->get();

        }
        else
        {
            $listcho = $this->cho->all();

        }

        if(isset($option['from']) && isset($option['to']))
        {
            foreach($listcho as $cho)
            {

                $result[] = array('tong'=>$this->logHoKinhDoanh->where('id_cho',$cho->id)->whereBetween('ngay_thay_doi',array($option['from'],$option['to']))->count());

            }

        }
        else
        {
            foreach($listcho as $cho)
            {

                $result[] = array('tong'=>$cho->getLogHoKinhDoanh()->count());

            }
        }
        return $result;
    }

    public function getSoHoKeKhai($option = null){
        $result = [];
        if(isset($option['cho']) && isset($option['nganh']))
        {
            $listcho = $this->cho->where('id',$option['cho'])->get();
            $listnganh = $this->nganhkinhdoanh->Where('id',$option['nganh'])->get();
        }
        else
        {
            $listcho = $this->cho->all();
            $listnganh = $this->nganhkinhdoanh->all();
        }
        $temp = [];
        foreach($listcho as $cho)
        {
            foreach($listnganh as $nganh)
            {
                if(isset($option['from']) && isset($option['to']))
                {

                    $totalhkd = $this->logHoKinhDoanh->Where('id_cho',$cho->id)->whereBetween('ngay_thay_doi',array($option['from'],$option['to']))->get()->count();
                    $dshokd = $this->logHoKinhDoanh->Where('id_cho',$cho->id)->whereBetween('ngay_thay_doi',array($option['from'],$option['to']))->get()->pluck("id_ho_kinh_doanh");
                }
                else
                {
                    $totalhkd = $this->logHoKinhDoanh->Where('id_cho',$cho->id)->get()->count();
                    $dshokd = $this->logHoKinhDoanh->Where('id_cho',$cho->id)->get()->pluck("id_ho_kinh_doanh");

                }
                $hoKeKhai = 0;
                foreach ($dshokd as $item)
                {
                    $hoKeKhai += $this->dsMHKD->Where('id_ho_kd',$item)->count() > 0 ? 1 : 0;
                }

                if($hoKeKhai != 0 && $totalhkd != 0)
                    $temp = array("tongsokekhai"=>$hoKeKhai,"tiso"=>($hoKeKhai/$totalhkd)*100);
                else
                    $temp = array("tongsokekhai"=>0,"tiso"=>0);
            }
            $result[$cho->ten] = $temp;
            $temp = [];
        }
        return $result;
    }

    public function getListKeKhai($option = null)
    {
        $result = array();
        if(isset($option['cho']) && isset($option['nganh']))
        {

            $listcho = $this->cho->where('id',$option['cho'])->get();
            $listnganh = $this->nganhkinhdoanh->where('id',$option['nganh'])->get();

        }
        else
        {
            $listcho = $this->cho->all();
            $listnganh = $this->nganhkinhdoanh->all();
        }

        $resultkd = [];
        foreach($listcho as $cho)
        {
            foreach($listnganh as $nganh)
            {
                if(isset($option['from']) && isset($option['to']))
                {
                    $dshokd = $this->logHoKinhDoanh->Where('id_nganh_kd',$nganh->id)->Where('id_cho',$cho->id)->whereBetween('ngay_thay_doi',array($option['from'],$option['to']))->get()->pluck("id_ho_kinh_doanh");
                    $hoKeKhai = 0;
                    foreach ($dshokd as $item)
                    {
                        $hoKeKhai += $this->dsMHKD->Where('id_ho_kd',$item)->count() > 0 ? 1 : 0;
                    }
                }
                else
                {
                    $dshokd = $this->logHoKinhDoanh->Where('id_nganh_kd',$nganh->id)->Where('id_cho',$cho->id)->get()->pluck("id_ho_kinh_doanh");
                    $hoKeKhai = 0;
                    foreach ($dshokd as $item)
                    {
                        $hoKeKhai += $this->dsMHKD->Where('id_ho_kd',$item)->count() > 0 ? 1 : 0;
                    }
                }

                $resultdone = array('nganh'=>$nganh->id,'soluong' => $hoKeKhai,'maCho'=>$cho->id);
                $resultkd[] = $resultdone;
            }
            $result[] = $resultkd;
            $resultkd = [];
        }
        return $result;
    }

    public function getGiayPhepATTP($option = null)
    {
        $result = [];
        if(isset($option['cho']) && !empty($option['cho']))
        {
            $listcho = $this->cho->where('id',$option['cho'])->get();

        }
        else
        {
            $listcho = $this->cho->all();

        }
        if(isset($option['from']) && isset($option['to']))
        {
            foreach($listcho as $cho)
            {
                $result[$cho->ten]  = array("dalam" => $this->logHoKinhDoanh->Where('giay_ATTP_Status',3)->Where('id_cho',$cho->id)->whereBetween('ngay_thay_doi',array($option['from'],$option['to']))->count(),"danglam" => $this->logHoKinhDoanh->Where('giay_ATTP_Status',1)->Where('id_cho',$cho->id)->whereBetween('ngay_thay_doi',array($option['from'],$option['to']))->count(),"chualam" => $this->logHoKinhDoanh->Where('giay_ATTP_Status',0)->Where('id_cho',$cho->id)->whereBetween('ngay_thay_doi',array($option['from'],$option['to']))->count() );
            }

        }
        else
        {
            foreach($listcho as $cho)
            {

                $result[$cho->ten]  = array("dalam" => $this->logHoKinhDoanh->Where('giay_ATTP_Status',3)->Where('id_cho',$cho->id)->count(),"danglam" => $this->logHoKinhDoanh->Where('giay_ATTP_Status',1)->Where('id_cho',$cho->id)->count(),"chualam" => $this->logHoKinhDoanh->Where('giay_ATTP_Status',0)->Where('id_cho',$cho->id)->count() );

            }
        }

        return $result;

    }


    public function getKeKhaiMHKD(Array $request = null)
    {
        if(isset($request['day']))
        {
            if(strpos($request['day'],'|'))
            {
                $days = explode("|",$request['day']);
                $fromDate = trim($days[0]);
                $toDate = trim($days[1]);
                $getListCho = $this->cho->all();
                $getListNganh = $this->nganhkinhdoanh->all();
                if(isset($fromDate) && isset($toDate))
                {
                    $getListCho = $this->cho->all();
                    $getListNganh = $this->nganhkinhdoanh->all();
                    $getListKeKhai = $this->getListKeKhai(array('from'=>$fromDate,'to'=>$toDate));
                    $getSoHoKeKhai = $this->getSoHoKeKhai(array('from'=>$fromDate,'to'=>$toDate));
                    $listSoHoKinhDoanh = $this->getListSoHoKinhDoanh(array('from'=>$fromDate,'to'=>$toDate));
                    $getGiayPhepATTP = $this->getGiayPhepATTP(array('from'=>$fromDate,'to'=>$toDate));

                }
            }
            elseif(isset($request['cho']) && isset($request['nganh']) && is_numeric($request['nganh']) && is_numeric($request['cho']))
            {
                $getListNganh = $this->nganhkinhdoanh->where('id',$request['nganh'])->get();
                $getListCho = $this->cho->where('id',$request['cho'])->get();
                $getListKeKhai = $this->getListKeKhai(array('cho'=>$request['cho'],'nganh'=>$request['nganh']));
                $listSoHoKinhDoanh = $this->getListSoHoKinhDoanh(array('cho'=>$request['cho']));
                $getGiayPhepATTP = $this->getGiayPhepATTP(array('cho'=>$request['cho'],'nganh'=>$request['nganh']));
                $getSoHoKeKhai = $this->getSoHoKeKhai(array('cho'=>$request['cho'],'nganh'=>$request['nganh']));
            }
            else
            {
                $getListCho = $this->cho->all();
                $getListNganh = $this->nganhkinhdoanh->all();
                $getListKeKhai = $this->getListKeKhai();
                $getGiayPhepATTP = $this->getGiayPhepATTP();
                $getSoHoKeKhai = $this->getSoHoKeKhai();
                $listSoHoKinhDoanh = $this->getListSoHoKinhDoanh();
            }
        }
        else
        {
            $getListCho = $this->cho->all();
            $getListNganh = $this->nganhkinhdoanh->all();
            $getListKeKhai = $this->getListKeKhai();
            $getGiayPhepATTP = $this->getGiayPhepATTP();
            $getSoHoKeKhai = $this->getSoHoKeKhai();
            $listSoHoKinhDoanh = $this->getListSoHoKinhDoanh();
        }


        return array('listSoHoKinhDoanh' => $listSoHoKinhDoanh,'getListNganh' => $getListNganh,'getListCho' => $getListCho,'getListKeKhai'=>$getListKeKhai,'getGiayPhepATTP' => $getGiayPhepATTP,'getSoHoKeKhai' => $getSoHoKeKhai);
    }
    public function getKeKhaiMHKDTruyenThong($query = null , $perPage = 10, $currentPage = null)
    {
        $dataSearch = [];
        $dataFilter = [];
        $data_sap=[];

        $listMatHangKinhDoanh = $this->dsmhkd;
        $listMatHangKinhDoanh = $listMatHangKinhDoanh->all();
        $listHoKinhDoanh = $this->hokinhdoanh;
        $listHoKinhDoanh = $listHoKinhDoanh->all();
        $listHoKinhDoanh = $listHoKinhDoanh->where('delete_at',0);
        $listSap = $this->sap->all();
        $listSap = $listSap->where('delete_at',0);
        $listCho = $this->cho->all();
        $listCho = $listCho->where('delete_at',0);
        $listNganhKD = $this->nganhkinhdoanh->all();
        //$listNganhKD = $listNganhKD->where('delete_at',0);

        if (isset($query['id_sap']) && $query['id_sap'] != '') {
            $id_sap = $query['id_sap'];
        }

        if (isset($id_sap) && $id_sap != null) {
            $listMatHangKinhDoanh = $this->dsmhkd->all();
            $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('id_sap', $id_sap);
            $list_sap = $this->sap->getByColumn('id', $id_sap);
            foreach ($list_sap as $item_sap) {
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('id_sap', $item_sap->id)->where('id_ho_kd', $item_sap->id_ho_kinh_doanh);
            }
        }

        if (isset($id_sap) && $id_sap != null) {
            $listSap = $listSap->where('id', $id_sap);
            $item_ho_kd ="";
            $item_sap ="";
            $item_cho= "";

            if ($listSap) {
                foreach ($listSap as $item_sap)
                {
                    $listHoKinhDoanh = $listHoKinhDoanh->where('id', $item_sap->id_ho_kinh_doanh);
                    foreach ($listHoKinhDoanh as $item_ho_kd)
                    {

                    }
                    $listCho = $listCho->where('id',$item_sap->id_cho);
                    foreach ($listCho as $item_cho)
                    {

                    }
                    if($item_ho_kd)
                    {
                        $listNganhKD = $listNganhKD->where('id',$item_ho_kd->id_nganh_kd);
                        foreach ($listNganhKD as $itemNganhKD)
                        {

                        }
                    }

                }
            }
            $dataSearch['data_ho_kinh_doanh'] = $item_ho_kd;
            $dataSearch['data_sap'] = $item_sap;
            $dataSearch['data_cho'] = $item_cho;
            $dataSearch['data_nganh_kinh_doanh'] =  (isset($itemNganhKD) ? $itemNganhKD : "");
        }
        if (isset($query['id_cho']) && $query['id_cho'] != '') {
            $id_cho = $query['id_cho'];
        }
        if(isset($id_cho) && $id_cho != null)
        {
            $data_sap = $this->sap->getListByMultiColumn(['id_cho'=>$id_cho,'delete_at'=>0]);
        }

        if (isset($query['value']) && $query['value'] != '') {
            $listHoKinhDoanh = $listHoKinhDoanh->where('ma_so_ho_kd', $query['value']);
            $listMatHangKinhDoanh =  [];
            //dd($listHoKinhDoanh);
            foreach ($listHoKinhDoanh as $item) {
                $list_Sap = $item->getSap;
                if ($list_Sap != null) {
                    $sap_array = array_pluck($list_Sap, 'id');

                }
                foreach ($sap_array as $item_sap) {
                    $list_mat_hang_kinh_doanh = $this->dsmhkd->getByColumn('id_sap', $item_sap);
                    $list_MatHangKinhDoanh = $this->dsmhkd->all();
                    if (isset($list_mat_hang_kinh_doanh)) {
                        if ($list_mat_hang_kinh_doanh->id_sap == $item_sap) {
                            $list_Mat_HangKinhDoanh = $list_MatHangKinhDoanh->where('id_sap', $item_sap)->where('id_ho_kd', $item->id);
                            foreach ( $list_Mat_HangKinhDoanh as $item_Mat_hang_kd)
                            {
                                $listMatHangKinhDoanh[] = $item_Mat_hang_kd;
                            }

                        }
                    }
                }
            }
        }
        if (isset($query['value']) && $query['value'] != '') {
            $listHoKinhDoanh = $listHoKinhDoanh->where('ma_so_ho_kd', $query['value']);
            if ($listHoKinhDoanh != "") {
                $item = "";
                $itemCho = "";
                $itemNganhKD = "";
                $id_Cho = "";
                $id_nganh_kd = "";
                $itemNganhKD = "";
                $list_Sap = "";
                foreach ($listHoKinhDoanh as $item) {
                    //dd($item);
                    $id_HoKinhDoanh = $item->id;
                    $id_Cho = $item->id_cho;
                    $id_nganh_kd = $item->id_nganh_kd;
                    if ($id_HoKinhDoanh) {
                        $list_Sap = $listSap->where('id_ho_kinh_doanh', $id_HoKinhDoanh);
                    }
                    if ($id_Cho) {
                        $listCho = $listCho->where('id', $id_Cho);
                        //dd($listCho);
                        if ($listCho) {
                            foreach ($listCho as $itemCho) {

                            }
                        }
                    }

                    if ($id_nganh_kd) {
                        $list_nganh_kd = $listNganhKD->where('id', $id_nganh_kd);
                        foreach ($list_nganh_kd as $itemNganhKD) {

                        }

                    }
                    $dataFilter['data_ho_kinh_doanh'] = $item;
                    $dataFilter['data_sap'] = $list_Sap;
                    $dataFilter['data_cho'] = $itemCho;
                    $dataFilter['data_nganh_kinh_doanh'] = (isset($itemNganhKD) ? $itemNganhKD : "");
                    //dd($dataFilter);

                }

            }
        }

        $list = [];
        if ($listMatHangKinhDoanh != "") {
            foreach ($listMatHangKinhDoanh as $item) {
                $sap = isset($item->getSap) ? $item->getSap : null;
                if ($sap != null) {
                    $sap_array = $sap->ten;
                    //dd($sap_array);
                }
                else{
                    $sap_array = "";
                }



                $co_so_cc_array = "";
                if (isset($item->getCoSoCungCap)) {
                    $co_so_cc_array = $item->getCoSoCungCap;
                }

                $dv_tinh = isset($item->getDonViTinh) ? $item->getDonViTinh : null;
                $don_vi_tinh_array = "";
                if ($dv_tinh != null) {
                    $don_vi_tinh_array = $dv_tinh->ten;

                }
                //dd($list);
                $listHoKinhDoanh = isset($item->getHoKinhDoanh) ? $item->getHoKinhDoanh : Null;
                $ho_kinh_doanh_array = "";
                if ($listHoKinhDoanh != null) {
                    $ho_kinh_doanh_array = $listHoKinhDoanh;
                }
                $item->id_co_so_cc = isset($co_so_cc_array) ? $co_so_cc_array : "";
                $item->ma_sap = isset($sap_array) ? $sap_array : "";
                $item->dv_tinh = isset($don_vi_tinh_array) ? $don_vi_tinh_array : '';
                $item->listHoKinhDoanh = isset($ho_kinh_doanh_array) ? $ho_kinh_doanh_array : '';
                $list[] = $item;

            }
        }
        else
        {
            $list = "";
        }
        //dd($list);
        return ['data' => $list, 'data_search' => $dataSearch, 'data_filler' => $dataFilter,'data_sap'=>$data_sap];
    }

}
