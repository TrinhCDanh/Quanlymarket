<?php

namespace App\Repositories\Eloquent;

use App\Models\HoKinhDoanh;
use App\Models\Sap;
use App\Models\DonViTinh;
use App\Models\CoSoCc;
use App\Models\DanhSachMatHangKd;

use App\Repositories\Contracts\ATTPRepositoryInterface;

class ATTPRepository implements ATTPRepositoryInterface
{
    private $hoKinhDoanh;
    private $sap;
    private $donvitinh;
    private $cosocungcap;
    private $danhsachmathangkd;

    public function __construct()
    {
        $this->hoKinhDoanh = new HoKinhDoanh();
        $this->sap = new Sap();
        $this->donvitinh = new DonViTinh();
        $this->cosocungcap = new CoSoCc();
        $this->danhsachmathangkd = new DanhSachMatHangKd();
    }


    public function get($id, $columns = array('*'))
    {
        $data = $this->hoKinhDoanh->find($id, $columns);
        if ($data) {
            return $data;
        }
        return null;

    }

    public function all($columns = array('*'))
    {
        $listData = $this->hoKinhDoanh->get($columns);
        return $listData;
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        $listData = $this->hoKinhDoanh->paginate($perPage, $columns);
        return $listData;
    }

    public function save(array $data)
    {
        return $this->hoKinhDoanh->create($data);

    }

    public function update(array $data, $id)
    {
        $dep = $this->hoKinhDoanh->find($id);
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

        $data = $this->hoKinhDoanh->where($column, $value)->first();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->hoKinhDoanh;

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

        $data = $this->hoKinhDoanh->where($column, $value)->get();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getListByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->hoKinhDoanh;

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
        $del = $this->hoKinhDoanh->find($id);
        if ($del !== null) {
            $del->delete();
            return true;
        } else {
            return false;
        }
    }

    public function deleteMulti(array $data)
    {
        $del = $this->hoKinhDoanh->whereIn("id", $data["list_id"])->delete();
        if ($del) {

            return true;
        } else {
            return false;
        }
    }

    public function getListThongKeTheoNhomNganh($perPage = 15,$currentPage = null,$query = null)
    {
        // TODO: Implement getListThongKeTheoNhomNganh() method.
        $listHoKinhDoanh = $this->hoKinhDoanh->paginate($perPage);
        $list = [];
        if ($listHoKinhDoanh) {
            foreach ($listHoKinhDoanh as $item) {
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
        return ['data'=>$list,'paginate' => $listHoKinhDoanh->links()];
    }

    /**
     * @param int $perPage
     * @param null $query
     * @return array
     */
    public  function getDanhSachATTP($perPage = 15, $query = null)
    {
            $listHoKinhDoanh = array();
            if(isset($query['cho']))
            {
                if(isset($query['key']) && isset($query['type']))
                {
                    $filter = array(2 => 'ma_so_ho_kd', 1 => 'ten_ho_kd');
                    $listHoKinhDoanh = $this->hoKinhDoanh->Where('id_cho', $query['cho'])->where($filter[$query['type']], 'like', '%'.$query['key'].'%')->paginate($perPage);
                }
                else
                {
                    if(isset($query['sort']))
                        $listHoKinhDoanh = $this->hoKinhDoanh->Where('id_cho', $query['cho'])->orderBy('ten_ho_kd', $query['sort'])->paginate($perPage);
                    else
                        $listHoKinhDoanh = $this->hoKinhDoanh->Where('id_cho', $query['cho'])->paginate($perPage);
                }

            }

        return $listHoKinhDoanh;
    }


}
