<?php

namespace App\Repositories\Eloquent;

use App\Models\NganhKinhDoanh;
use App\Repositories\Contracts\NganhKinhDoanhRepositoryInterface;

class NganhKinhDoanhRepository implements NganhKinhDoanhRepositoryInterface
{
    private $nganhKinhDoanh;

    public function __construct()
    {
        $this->nganhKinhDoanh = new NganhKinhDoanh();
    }


    public function get($id, $columns = array('*'))
    {
        $data = $this->nganhKinhDoanh->find($id, $columns);
        if ($data) {
            return $data;
        }
        return null;

    }

    public function all($columns = array('*'))
    {
        $listData = $this->nganhKinhDoanh->get($columns);
        return $listData;
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        $listData = $this->nganhKinhDoanh->paginate($perPage, $columns);
        return $listData;
    }

    public function save(array $data)
    {
        return $this->nganhKinhDoanh->create($data);

    }

    public function update(array $data, $id)
    {
        $dep = $this->nganhKinhDoanh->find($id);
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

        $data = $this->nganhKinhDoanh->where($column, $value)->first();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->nganhKinhDoanh;

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

        $data = $this->nganhKinhDoanh->where($column, $value)->get();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getListByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->nganhKinhDoanh;

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
        $del = $this->nganhKinhDoanh->find($id);
        if ($del !== null) {
            $del->delete();
            return true;
        } else {
            return false;
        }
    }

    public function deleteMulti(array $data)
    {
        $del = $this->nganhKinhDoanh->whereIn("id", $data["list_id"])->delete();
        if ($del) {

            return true;
        } else {
            return false;
        }
    }

    public function getListNganhKinhDoanh ($perPage = 10, $currentPage = null, $query = null)
    {
        $searchValue = null;
        $searchOption = null;

        $list = null;
        $list = $this->nganhKinhDoanh;
        if ($query != null) {
            if (isset($query['searchValue']) && $query['searchValue'] != '' && $query['searchOption'] == 1 ) {
                $list = $list->Where('ten_nganh','like','%'.$query['searchValue'].'%');
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

}
