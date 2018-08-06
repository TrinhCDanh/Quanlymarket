<?php 
namespace App\Repositories\Eloquent; 
 
use App\Repositories\Contracts\LogHoKinhDoanhRepositoryInterface;
use App\Models\LogHoKinhDoanh;
 
class LogHoKinhDoanhRepository implements LogHoKinhDoanhRepositoryInterface 
{ 
	private $logHoKinhDoanh; 
	public function __construct() { $this->logHoKinhDoanh = new LogHoKinhDoanh();}
                 
 
	public function get($id,$columns = array('*'))
        {
                    $data = $this->logHoKinhDoanh->find($id, $columns);
                        if ($data)
                        {
                            return $data;
                        }
                        return null;
        
        }  
	public function all($columns = array('*'))
        {
            $listData = $this->logHoKinhDoanh->get($columns);
            return $listData;
        }  
	public function paginate($perPage = 15,$columns = array('*'))
        {
            $listData = $this->logHoKinhDoanh->paginate($perPage, $columns);
            return $listData;
        }  
	public function save(array $data) 
        {
        return $this->logHoKinhDoanh->create($data);
            
        }  
	public function update(array $data,$id) {
         $dep =  $this->logHoKinhDoanh->find($id);
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
        
             $data = $this->logHoKinhDoanh->where($column,$value)->first();
            if ($data)
            {
                return $data;
            }
            return null;
        
        
        }  
	public function getByMultiColumn(array $where,$columnsSelected = array('*')) 
        {
        
             $data = $this->logHoKinhDoanh;
           
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
        
             $data = $this->logHoKinhDoanh->where($column,$value)->get();
            if ($data)
            {
                return $data;
            }
            return null;
        
        
        }  
	public function getListByMultiColumn(array $where,$columnsSelected = array('*')) 
        {
        
             $data = $this->logHoKinhDoanh;
             
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
            $del = $this->logHoKinhDoanh->find($id);
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
            $del = $this->logHoKinhDoanh->whereIn("id",$data["list_id"])->delete();
            if ($del)
            {
              
                return true;
            }
            else{
                return false;
            }
        } 
         
} 