<?php

namespace App\Repositories\Eloquent;

use App\Models\CoSoCc;
use App\Repositories\Contracts\CoSoCungCapRepositoryInterface;
use DB;

class CoSoCungCapRepository implements CoSoCungCapRepositoryInterface
{
    private $coSoCungCap;

    public function __construct()
    {
        $this->coSoCungCap = new CoSoCc();
    }


    public function get($id,$columns = array('*'))
    {
        $data = $this->coSoCungCap->find($id, $columns);
            if ($data)
            {
                return $data;
            }
            return null;

    }

    public function all($columns = array('*'))
    {
        $listData = $this->coSoCungCap->get($columns);
        return $listData;
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        $listData = $this->coSoCungCap->paginate($perPage, $columns);
        return $listData;
    }

    public function save(array $data)
    {
        return $this->coSoCungCap->create($data);

    }

    public function update(array $data, $id)
    {
        $dep = $this->coSoCungCap->find($id);
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

        $data = $this->coSoCungCap->where($column, $value)->first();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->coSoCungCap;

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

        $data = $this->coSoCungCap->where($column, $value)->get();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getListByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->coSoCungCap;

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
        $del = $this->coSoCungCap->find($id);
        if ($del !== null) {
            $del->delete();
            return true;
        } else {
            return false;
        }
    }

    public function deleteMulti(array $data)
    {
        $del = $this->coSoCungCap->whereIn("id", $data["list_id"])->delete();
        if ($del) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param int $perPage
     * @param null $currentPage
     * @param null $query
     * @return array
     */
    public function getListCoSoCungCap($perPage = 15, $currentPage = null, $query = null)
    {
        $searchValue = null;
        $searchOption = null;

        $list = null;
        $list = $this->coSoCungCap;
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

    public function deleteCoSoCungCap($id)
    {
        $del = DB::table('co_so_cc')->where('id', $id)->update(['delete_at' => 1]);
        return $del;
    }

}
