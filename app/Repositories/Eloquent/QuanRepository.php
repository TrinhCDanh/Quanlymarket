<?php
namespace App\Repositories\Eloquent;

use App\Models\Quan;
use App\Repositories\Contracts\QuanRepositoryInterface;

class QuanRepository implements QuanRepositoryInterface
{
	private $quan;
	public function __construct() { $this->quan = new Quan();}


	public function get($id,$columns = array('*'))
        {
                    $data = $this->quan->find($id, $columns);
                        if ($data)
                        {
                            return $data;
                        }
                        return null;

        }
	public function all($columns = array('*'))
        {
            $listData = $this->quan->get($columns);
            return $listData;
        }
	public function paginate($perPage = 15,$columns = array('*'))
        {
            $listData = $this->quan->paginate($perPage, $columns);
            return $listData;
        }
	public function save(array $data)
        {
        return $this->quan->create($data);

        }
	public function update(array $data,$id) {
         $dep =  $this->quan->find($id);
        if ($dep)
        {
            foreach ($dep->getFillable() as $field)
            {
                if (array_key_exists($field,$data)){
                    $dep->$field = $data[$field];
                }
            }
            if ($dep->save())
            {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
        }
	public function getByColumn($column,$value,$columnsSelected = array('*'))
        {

             $data = $this->quan->where($column,$value)->first();
            if ($data)
            {
                return $data;
            }
            return null;


        }
	public function getByMultiColumn(array $where,$columnsSelected = array('*'))
        {

             $data = $this->quan;

            foreach ($where as $key => $value) {
                $data = $data->where($key, $value);
            }

            $data = $data->first();


            if ($data)
            {
                return $data;
            }
            return null;


        }
	public function getListByColumn($column,$value,$columnsSelected = array('*'))
        {

             $data = $this->quan->where($column,$value)->get();
            if ($data)
            {
                return $data;
            }
            return null;


        }
	public function getListByMultiColumn(array $where,$columnsSelected = array('*'))
        {

             $data = $this->quan;

              foreach ($where as $key => $value) {
            $data = $data->where($key, $value);
        }

        $data = $data->get();

            if ($data)
            {
                return $data;
            }
            return null;


        }
	public function delete($id)
        {
            $del = $this->quan->find($id);
            if ($del !== null)
            {
                $del->delete();
                return true;
            }
            else{
                return false;
            }
        }

	public function deleteMulti(array $data)
        {
            $del = $this->quan->whereIn("id",$data["list_id"])->delete();
            if ($del)
            {

                return true;
            }
            else{
                return false;
            }
        }

}
