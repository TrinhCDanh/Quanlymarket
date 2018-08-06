<?php

namespace App\Repositories\Eloquent;

use App\Models\DanhSachMatHangKd;
use App\Models\Sap;
use App\Models\HoKinhDoanh;
use App\Models\Phuong;
use App\Models\Cho;
use App\Models\NganhKinhDoanh;
use App\Repositories\Contracts\MatHangKinhDoanhRepositoryInterface;

class MatHangKinhDoanhRepository implements MatHangKinhDoanhRepositoryInterface
{
    private $matHangKinhDoanh;
    private $hoKinhDoanh;
    private $phuong;
    private $cho;
    private $nganhKinhDoanh;

    public function __construct()
    {
        $this->matHangKinhDoanh = new DanhSachMatHangKd();
        $this->sap = new sap();
        $this->hoKinhDoanh = new HoKinhDoanh();
        $this->phuong = new Phuong();
        $this->cho = new Cho();
        $this->nganhKinhDoanh = new NganhKinhDoanh();
    }


    public function get($id, $columns = array('*'))
    {
        $data = $this->matHangKinhDoanh->find($id, $columns);
        if ($data) {
            return $data;
        }
        return null;

    }

    public function all($columns = array('*'))
    {
        $listData = $this->matHangKinhDoanh->get($columns);
        return $listData;
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        $listData = $this->matHangKinhDoanh->paginate($perPage, $columns);
        return $listData;
    }

    public function save(array $data)
    {
        return $this->matHangKinhDoanh->create($data);

    }

    public function update(array $data, $id)
    {
        $dep = $this->matHangKinhDoanh->find($id);
        if ($dep) {
            foreach ($dep->getFillable() as $field) {
                if (array_key_exists($field, $data)) {
                    $dep->$field = $data[$field];
                }
            }
            if ($dep->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getByColumn($column, $value, $columnsSelected = array('*'))
    {

        $data = $this->matHangKinhDoanh->where($column, $value)->first();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->matHangKinhDoanh;

        foreach ($where as $key => $value) {
            $data = $data->where($key, $value);
        }

        $data = $data->first();


        if ($data) {
            return $data;
        }
        return null;


    }

    public function getListByColumn($column, $value, $columnsSelected = array('*'))
    {

        $data = $this->matHangKinhDoanh->where($column, $value)->get();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getListByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->matHangKinhDoanh;

        foreach ($where as $key => $value) {
            $data = $data->where($key, $value);
        }

        $data = $data->get();

        if ($data) {
            return $data;
        }
        return null;


    }

    public function delete($id)
    {
        $del = $this->matHangKinhDoanh->find($id);
        if ($del !== null) {
            $del->delete();
            return true;
        } else {
            return false;
        }
    }

    public function deleteMulti(array $data)
    {
        $del = $this->matHangKinhDoanh->whereIn("id", $data["list_id"])->delete();
        if ($del) {

            return true;
        } else {
            return false;
        }
    }

    public function getListThongKeTheoNhomNganh($perPage = 15, $currentPage = null, $query = null)
    {
        // TODO: Implement getListThongKeTheoNhomNganh() method.
        $listMatHangKinhDoanh = $this->matHangKinhDoanh;
        if ($query != null){
            if (isset($query['key']) && $query['key'] != '' && $query['type'] == 0 ){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->OrWhere('ma_so_ho_kd','like','%'.$query['key'].'%');
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->OrWhere('ten_ho_kd','like','%'.$query['key'].'%');
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->OrWhere('sdt_ho_kd','like','%'.$query['key'].'%');
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->OrWhere('ho_chu_ho_kd','like','%'.$query['key'].'%');
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->OrWhere('ten_chu_ho_kd','like','%'.$query['key'].'%');
            }

            if (isset($query['key']) && $query['key'] != '' && $query['type'] == 2 ){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('ma_so_ho_kd','like','%'.$query['key'].'%');
            }
            if (isset($query['key']) && $query['key'] != '' && $query['type'] == 1 ){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('ten_ho_kd','like','%'.$query['key'].'%');
            }

            if (isset($query['sort']) && $query['sort'] != ''  ){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->orderBy('id',$query['sort']);
            }
            if (isset($query['cho']) && $query['cho'] != ''  ){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('id_cho',$query['cho']);
            }
            if (isset($query['nganh']) && $query['nganh'] != ''  ){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('id_nganh_kd',$query['nganh']);
            }
            if (isset($query['cho']) && $query['cho'] != '' && $query['nganh'] == ''  ){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('id_cho',$query['cho']);
            }
            if (isset($query['nganh']) && $query['nganh'] != '' && $query['cho'] == ''  ){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('id_nganh_kd',$query['nganh']);
            }


        }
        $listMatHangKinhDoanh = $listMatHangKinhDoanh->paginate($perPage);
        $list = [];
        if ($listMatHangKinhDoanh) {
            foreach ($listMatHangKinhDoanh as $item) {
                $sap = isset($item->getSap) ? $item->getSap : null;
                if ($sap != null) {
                    $sap_array = array_pluck($sap->toArray(), 'ma_so_sap');
                }
                $listMatHangKinhDoanh = [];
                if (isset($item->getDanhSachMatHangKinhDoanh)) {
                    $danhSachMatHang = $item->getDanhSachMatHangKinhDoanh;
                    if ($danhSachMatHang) {
                        foreach ($danhSachMatHang as $matHang) {
                            $listMatHangKinhDoanh[] = $matHang;
                        }
                    }
                }

                $item->ma_sap = isset($sap_array) ? implode($sap_array, ',') : null;
                $item->mat_hang_kinh_doanh = isset($listMatHangKinhDoanh) ? $listMatHangKinhDoanh : null;
                $list[] = $item;
            }
        }
        return ['data' => $list, 'paginate' => $listMatHangKinhDoanh->links()];
    }

    public function getListMatHangKinhDoanhByHo($id_ho, $perPage = 15, $currentPage = null, $query = null)
    {
        // TODO: Implement getListThongKeTheoNhomNganh() method.
        $ho_info = $this->hoKinhDoanh->find($id_ho);
        $phuong = $this->phuong->get();
        $cho = $this->cho->get();
        $nganhKinhDoanh = $this->nganhKinhDoanh->get();

        $listMatHangKinhDoanh = $this->matHangKinhDoanh->where(['id_ho_kd' => $id_ho]);

        if(!empty($query)){
            if(isset($query['sort'])){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->orderBy('id',$query['sort']);
            }
            if(isset($query['sap'])){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('id_sap',$query['sap']);
            }
            if(isset($query['key'])){
                $listMatHangKinhDoanh = $listMatHangKinhDoanh->where('ten', 'like','%'.$query['key'].'%');
            }
        }

        $listMatHangKinhDoanh = $listMatHangKinhDoanh->paginate($perPage);
        // $listMatHangKinhDoanh = $this->matHangKinhDoanh->where(['id_ho_kd' => $id_ho])->paginate($perPage);
        $list = [];
        if ($listMatHangKinhDoanh) {
            foreach ($listMatHangKinhDoanh as $item) {
                $sap = isset($item->getSap) ? $item->getSap : null;
                if ($sap != null) {
                    $sap_array = array_pluck($sap->toArray(), 'ten');
                }
                $listMatHangKinhDoanh = [];
                if (isset($item->getDanhSachMatHangKinhDoanh)) {
                    $danhSachMatHang = $item->getDanhSachMatHangKinhDoanh;
                    if ($danhSachMatHang) {
                        foreach ($danhSachMatHang as $matHang) {
                            $listMatHangKinhDoanh[] = $matHang;
                        }
                    }
                }

                $item->ma_sap = isset($sap_array) ? implode($sap_array, ',') : null;
                $item->mat_hang_kinh_doanh = isset($listMatHangKinhDoanh) ? $listMatHangKinhDoanh : null;
                $list[] = $item;
            }
        }
        // return ['data' => $list, 'paginate' => $listMatHangKinhDoanh->links()];
        return ['data' => $list,'ho_info' => $ho_info, 'phuong' => $phuong, 'cho' => $cho, 'nganhKinhDoanh' => $nganhKinhDoanh, 'paginate' => $listMatHangKinhDoanh];
    }

}
