<?php

namespace App\Repositories\Eloquent;

use App\Models\Cho;
use App\Repositories\Contracts\ChoRepositoryInterface;

class ChoRepository implements ChoRepositoryInterface
{
    private $cho;

    public function __construct()
    {
        $this->cho = new Cho();
    }

    public function getListCho($request,$perPage=15,$currentPage = null)
    {
        if($request->has("searchValue"))
        {
            $list = $this->cho->Where("ten",'like','%'.$request->input("searchValue").'%')->OrWhere('dia_chi','like','%'.$request->input("searchValue").'%')->paginate($this->cho->get()->count());
        }

        else
        $list = $this->cho->paginate($perPage);

        return array('data'=>$list,'paginate'=>$list->links());
    }
    public function get($id, $columns = array('*'))
    {
        $data = $this->cho->find($id, $columns);
        if ($data) {
            return $data;
        }
        return null;

    }

    public function all($columns = array('*'))
    {
        $listData = $this->cho->get($columns);
        return $listData;
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        $listData = $this->cho->paginate($perPage, $columns);
        return $listData;
    }

    public function save(array $data)
    {
        return $this->cho->create($data);

    }

    public function update(array $data, $id)
    {
        $dep = $this->cho->find($id);
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

        $data = $this->cho->where($column, $value)->first();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->cho;

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

        $data = $this->cho->where($column, $value)->get();
        if ($data) {
            return $data;
        }
        return null;


    }

    public function getListByMultiColumn(array $where, $columnsSelected = array('*'))
    {

        $data = $this->cho;

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
        $del = $this->cho->find($id);
        if ($del !== null) {
            $del->delete();
            return true;
        } else {
            return false;
        }
    }

    public function deleteMulti(array $data)
    {
        $del = $this->cho->whereIn("id", $data["list_id"])->delete();
        if ($del) {

            return true;
        } else {
            return false;
        }
    }

    public function getTenCho($idCho)
    {
        $data = $this->cho->where('id',$idCho)->get();
        return $data;
    }

}
