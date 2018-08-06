<?php

namespace App\Repositories\Eloquent;

use App\Models\DonViTinh;
use App\Repositories\Contracts\DonViTinhRepositoryInterface;
use DB;

class DonViTinhRepository implements DonViTinhRepositoryInterface
{
    private $DonViTinh;

    public function __construct()
    {
        $this->DonViTinh = new DonViTinh();
    }


    public function get($id,$columns = array('*'))
    {
        $data = $this->DonViTinh->find($id, $columns);
            if ($data)
            {
                return $data;
            }
            return null;

    }

    public function all($columns = array('*'))
    {
        $listData = $this->DonViTinh->get($columns);
        return $listData;
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        $listData = $this->DonViTinh->paginate($perPage, $columns);
        return $listData;
    }

    public function save(array $data)
    {
        return $this->DonViTinh->create($data);

    }

    public function update(array $data, $id)
    {
        $dep = $this->DonViTinh->find($id);
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

        $data = $this->DonViTinh->where($column, $value)->first();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->DonViTinh;

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

        $data = $this->DonViTinh->where($column, $value)->get();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getListByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->DonViTinh;

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
        $del = $this->DonViTinh->find($id);
        if ($del !== null) {
            $del->delete();
            return true;
        } else {
            return false;
        }
    }

    public function deleteMulti(array $data)
    {
        $del = $this->DonViTinh->whereIn("id", $data["list_id"])->delete();
        if ($del) {
            return true;
        } else {
            return false;
        }
    }

    public function getListDonViTinh($perPage = 15, $currentPage = null, $query = null)
    {
        $searchValue = null;
        $searchOption = null;

        $list = null;
        $list = $this->DonViTinh;
        if ($query != null) {
            if (isset($query['searchValue']) && $query['searchValue'] != '' && $query['searchOption'] == 1 ) {
                $list = $list->Where('ten','like','%'.$query['searchValue'].'%');
                $list = $list->orWhere('sdt','like','%'.$query['searchValue'].'%');
            }
            if (isset($query['searchValue']) && $query['searchValue'] != '' && $query['searchOption'] == 2) {
                $list = $list->Where('ten','like','%'.$query['searchValue'].'%');
            }
            if (isset($query['searchValue']) && $query['searchValue'] != '' && $query['searchOption'] == 3) {
                $list = $list->Where('sdt','like','%'.$query['searchValue'].'%');
            }
        }
        $list = $list->paginate($perPage);
        //     if (!$list->isEmpty()) {
        //         //$array[] = ['data'=>$nk,'so_ho_khau'=>$item];
        //         $array[] = $list;
        //     }
        // $data = [];
        // $dataResult = [];
        // $i=1;
        // if($array != null){
        //     foreach ($array[0] as $item) {
        //         $data['stt'] = $i;
        //         $i++;
        //         $data['id'] = DB::table('co_so_cc')
        //         ->select('co_so_cc.id')
        //         ->where('id', $item->id)
        //         ->get();
        //         $data['ten'] = DB::table('co_so_cc')
        //         ->select('co_so_cc.ten')
        //         ->where('id', $item->id)
        //         ->get();
        //         $data['sdt'] = DB::table('co_so_cc')
        //         ->select('co_so_cc.sdt')
        //         ->where('id', $item->id)
        //         ->get();
        //         $data['dia_chi'] = DB::table('co_so_cc')
        //         ->select('co_so_cc.dia_chi')
        //         ->where('id', $item->id)
        //         ->get();
        //         $dataResult[] = $data;
        //     }
        // }
        // $count = count($dataResult);
        return ['data' => $list, 'paginate' => $list->total()];
        
    }

}
