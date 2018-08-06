<?php

namespace App\Repositories\Eloquent;

use App\Models\Sap;
use App\Repositories\Contracts\SapRepositoryInterface;
use DB;

class SapRepository implements SapRepositoryInterface
{
    private $sap;

    public function __construct()
    {
        $this->sap = new Sap();
    }


    public function get($id,$columns = array('*'))
    {
        $data = $this->sap->find($id, $columns);
            if ($data)
            {
                return $data;
            }
            return null;

    }

    public function all($columns = array('*'))
    {
        $listData = $this->sap->get($columns);
        return $listData;
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        $listData = $this->sap->paginate($perPage, $columns);
        return $listData;
    }

    public function save(array $data)
    {
        return $this->sap->create($data);

    }

    public function update(array $data, $id)
    {
        $dep = $this->sap->find($id);
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

        $data = $this->sap->where($column, $value)->get();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->sap;

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

        $data = $this->sap->where($column, $value)->get();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getListByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->sap;

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
        $del = $this->sap->find($id);
        if ($del !== null) {
            $del->delete();
            return true;
        } else {
            return false;
        }
    }

    public function deleteMulti(array $data)
    {
        $del = $this->sap->whereIn("id", $data["list_id"])->delete();
        if ($del) {

            return true;
        } else {
            return false;
        }
    }

    public function getListSap($perPage = 15, $currentPage = null, $query = null)
    {
        $searchValue = null;
        $searchOption = null;

        $list = null;
        $list = $this->sap->select('sap.*');
        $list = $list->where('sap.delete_at',0);
        $list = $list->join('cho', 'sap.id_cho', '=', 'cho.id');
        if ($query != null) {
            if (isset($query['id_cho']) && $query['id_cho'] != '') {
                $list = $list->where('sap.id_cho', $query['id_cho']);
            }
            if (isset($query['searchValue']) && $query['searchValue'] != '' && $query['searchOption'] == 1 ) {
                $list = $list->Where('ma_so_sap','like','%'.$query['searchValue'].'%');
                $list = $list->orWhere('sap.ten','like','%'.$query['searchValue'].'%');
                $list = $list->orWhere('cho.ten','like','%'.$query['searchValue'].'%');
            }
            if (isset($query['searchValue']) && $query['searchValue'] != '' && $query['searchOption'] == 2) {
                $list = $list->Where('ma_so_sap','like','%'.$query['searchValue'].'%');
            }
            if (isset($query['searchValue']) && $query['searchValue'] != '' && $query['searchOption'] == 3) {
                $list = $list->Where('sap.ten','like','%'.$query['searchValue'].'%');
            }
            if (isset($query['searchValue']) && $query['searchValue'] != '' && $query['searchOption'] == 4) {
                $list = $list->join('ho_kinh_doanh', 'sap.id_ho_kinh_doanh', '=', 'ho_kinh_doanh.id');
                $list = $list->Where('ho_kinh_doanh.ten_ho_kd','like','%'.$query['searchValue'].'%');
            }
        }
        if ($query != null  && isset($query['paginate'])){
            $list = $list->paginate($query['paginate']);
        }
        else{
            $list = $list->paginate(10);
        }
        if ($query != null){
            $list->appends($query);
        }
        return ['data' => $list, 'paginate' => $list->links(), 'total' => $list->total()];
    }

    public function deleteHoKinhDoanh($id)
    {
        $del = DB::table('sap')->where('id', $id)->update(['id_ho_kinh_doanh' => null]);
        return $del;
    }

    public function deleteSap($id)
    {
        $del = DB::table('sap')->where('id', $id)->update(['delete_at' => null]);
        return $del;
    }

    public function updateIdHoKinhDoanh(array $idSap,$idHoKinhDoanh)
    {
        // dd($idSap);
        //$update = DB::table('sap')->where('id',$id)->update(['id_ho_kinh' => $idHoKinhDoanh]);
        //dd($idSap[0]);
        foreach ($idSap[0] as $item){
            foreach($item[0] as $item1 ){
                // print_r($item[0]->id);
                $this->sap->where(['id' => $item1])->update([
                    'id_ho_kinh_doanh' => $idHoKinhDoanh
                ]);
            }
            //$update = DB::table('sap')->where(['id' => $item])->update(['id_ho_kinh_doanh' => $idHoKinhDoanh]);
        }
        // die;
    }
    public function getIdSap($ten,$idCho)
    {
        $idSap = $this->sap->select('id')->where('ten',$ten)->where('id_cho',$idCho)->get()->toArray();
        return $idSap;
    }

    public function getIdHoKinhDoanh($ten,$idCho)
    {
        $idSap = $this->sap->select('id_ho_kinh_doanh')->where('ten',$ten)->where('id_cho',$idCho)->get()->toArray();
        return $idSap;
    }

    public function getIdTenSap($ten,$idCho)
    {
        $idSap = $this->sap->select('id','ten')->where('ten',$ten)->where('id_cho',$idCho)->get();
        return $idSap;
    }
    public function getListSapByID($id,$value)
    {

        $data = $this->sap;
        $data = $data->where('id_cho', $value)->where('id_ho_kinh_doanh',$id)->orWhere('id_ho_kinh_doanh', null);
        $data = $data->get();
        dd($data);


        if ($data) {
            return $data;
        }
        return null;


    }
}
