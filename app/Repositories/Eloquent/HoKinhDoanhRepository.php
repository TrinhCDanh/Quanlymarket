<?php
namespace App\Repositories\Eloquent;

use App\Models\HoKinhDoanh;
use App\Models\Sap;
use App\Models\Cho;
use App\Repositories\Contracts\HoKinhDoanhRepositoryInterface;
use App\Repositories\Contracts\SapRepositoryInterface;
use http\Env\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\elementType;

class HoKinhDoanhRepository implements HoKinhDoanhRepositoryInterface
{
    private $hoKinhDoanh;
    private $sap;

    public function __construct(SapRepositoryInterface $sapRepository)
    {

        $this->hoKinhDoanh = new HoKinhDoanh();
        $this->sap = $sapRepository;
        $this->cho = new Cho();
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

    public function getListThongKeTheoNhomNganh($perPage = 15, $currentPage = null, $query = null)
    {
        // TODO: Implement getListThongKeTheoNhomNganh() method.
        $listHoKinhDoanh = $this->hoKinhDoanh;
        if ($query != null) {
            if (isset($query['key']) && $query['key'] != '' && $query['type'] == 0) {
                $listHoKinhDoanh = $listHoKinhDoanh->OrWhere('ma_so_ho_kd', 'like', '%' . $query['key'] . '%');
                $listHoKinhDoanh = $listHoKinhDoanh->OrWhere('ten_ho_kd', 'like', '%' . $query['key'] . '%');
                $listHoKinhDoanh = $listHoKinhDoanh->OrWhere('sdt_ho_kd', 'like', '%' . $query['key'] . '%');
                $listHoKinhDoanh = $listHoKinhDoanh->OrWhere('ho_chu_ho_kd', 'like', '%' . $query['key'] . '%');
                $listHoKinhDoanh = $listHoKinhDoanh->OrWhere('ten_chu_ho_kd', 'like', '%' . $query['key'] . '%');

            }

            if (isset($query['key']) && $query['key'] != '' && $query['type'] == 2) {
                $listHoKinhDoanh = $listHoKinhDoanh->where('ma_so_ho_kd', 'like', '%' . $query['key'] . '%');
            }
            if (isset($query['key']) && $query['key'] != '' && $query['type'] == 1) {
                $listHoKinhDoanh = $listHoKinhDoanh->where('ten_ho_kd', 'like', '%' . $query['key'] . '%');
            }

            if (isset($query['sort']) && $query['sort'] != '') {
                $listHoKinhDoanh = $listHoKinhDoanh->orderBy('id', $query['sort']);
            }
            if (isset($query['cho']) && $query['cho'] != '') {
                $listHoKinhDoanh = $listHoKinhDoanh->where('id_cho', $query['cho']);
            }
            if (isset($query['nganh']) && $query['nganh'] != '') {
                $listHoKinhDoanh = $listHoKinhDoanh->where('id_nganh_kd', $query['nganh']);
            }
        }

        $listHoKinhDoanh = $listHoKinhDoanh->paginate($perPage);
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
        return ['data' => $list, 'paginate' => $listHoKinhDoanh->links()];
    }

    public function getListHoKinhDoanh( $query = null,$perPage = 10, $currentPage = null)
    {
        // TODO: Implement getListHoKinhDoanh() method.
        $orderBy = null;
        $orderBySTT = null;
        $id_cho = null;
        $listHoKinhDoanh = $this->hoKinhDoanh;
        $listHoKinhDoanh = $listHoKinhDoanh->where('delete_at', 0);
        //Tìm Kiếm Hộ Kinh Doanh
        if (!empty($query)) {
            if (isset($query['tu_khoa']) && $query['tu_khoa'] == '1' && $query['value'] != '') {
                $listHoKinhDoanh = $listHoKinhDoanh->where('ma_so_ho_kd', 'LIKE', '%' . $query['value'] . '%');
            }

            if (isset($query['tu_khoa']) && $query['tu_khoa'] == '2' && $query['value'] != '') {
                $listHoKinhDoanh = $listHoKinhDoanh->where('ten_ho_kd', 'LIKE', '%' . $query['value'] . '%');

            }

            if (isset($query['tu_khoa']) && $query['tu_khoa'] == '3' && $query['value'] != '') {
                $listHoKinhDoanh = $listHoKinhDoanh->where('sdt_ho_kd', 'LIKE', '%' . $query['value'] . '%');
            }
            if (isset($query['tu_khoa']) && $query['tu_khoa'] == '4' && $query['value'] != '') {
                $listHoKinhDoanh = $listHoKinhDoanh->where('email_ho_kd', 'LIKE', '%' . $query['value'] . '%');
            }
            if (isset($query['tu_khoa']) && $query['tu_khoa'] == '5' && $query['value'] != '') {
                $listHoKinhDoanh = $listHoKinhDoanh->where('ma_so_giay_to', 'LIKE', '%' . $query['value'] . '%');
            }
        }
       // Sắp Xếp Hộ Kinh Doanh
        if (isset($query['orderBy']) && $query['orderBy'] == '1' && isset($query['orderBySTT'])&& $query['orderBySTT'] == '1') {
            $listHoKinhDoanh = $listHoKinhDoanh->orderByRaw('ISNULL(ten_ho_kd), ten_ho_kd DESC')->orderBy('ten_ho_kd', 'DESC');
        } elseif (isset($query['orderBy']) && $query['orderBy'] == '1' && isset($query['orderBySTT'])&& $query['orderBySTT'] == '2') {
            $listHoKinhDoanh = $listHoKinhDoanh->orderByRaw('ISNULL(ten_ho_kd), ten_ho_kd ASC')->orderBy('ten_ho_kd', 'ASC');
        }
        if (isset($query['orderBy']) && $query['orderBy'] == '2' && isset($query['orderBySTT'])&& $query['orderBySTT'] == '1') {
            $listHoKinhDoanh = $listHoKinhDoanh->orderBy('ngay_cap_giay_to', 'DESC');
        } elseif (isset($query['orderBy']) && $query['orderBy'] == '2' && isset($query['orderBySTT'])&& $query['orderBySTT'] == '2') {
            $listHoKinhDoanh = $listHoKinhDoanh->orderBy('ngay_cap_giay_to', 'ASC');
        }
        if (isset($query['orderBy']) && $query['orderBy'] == '3' && isset($query['orderBySTT'])&& $query['orderBySTT'] == '1') {
            $listHoKinhDoanh = $listHoKinhDoanh->orderByRaw('ISNULL(ten_chu_ho_kd), ten_chu_ho_kd DESC')->orderBy('ten_chu_ho_kd', 'DESC');
        } elseif (isset($query['orderBy']) && $query['orderBy'] == '3' && isset($query['orderBySTT'])&& $query['orderBySTT'] == '2') {
            $listHoKinhDoanh = $listHoKinhDoanh->orderByRaw('ISNULL(ten_chu_ho_kd), ten_chu_ho_kd ASC')->orderBy('ten_chu_ho_kd', 'ASC');
        }
        if (isset($query['orderBy']) && $query['orderBy'] == '4' && isset($query['orderBySTT'])&& $query['orderBySTT'] == '1') {
            $listHoKinhDoanh = $listHoKinhDoanh->orderBy('id', 'DESC');
        } elseif (isset($query['orderBy']) && $query['orderBy'] == '4' && isset($query['orderBySTT'])&& $query['orderBySTT'] == '2') {
            $listHoKinhDoanh = $listHoKinhDoanh->orderBy('id', 'ASC');
        }
        //Lọc Hộ Kinh Doanh
        if (isset($query['id_cho']) && $query['id_cho'] != '') {
            $id_cho = $query['id_cho'];
        }
        if (isset($id_cho)&& $id_cho != null) {
            $listHoKinhDoanh = $listHoKinhDoanh->where('id_cho', $id_cho);
        }
        if (isset($query['id_nganh_kd']) && $query['id_nganh_kd'] != '') {
            $id_nganh_kd = $query['id_nganh_kd'];
        }
        if (isset($id_nganh_kd) && $id_nganh_kd != null) {
            $listHoKinhDoanh = $listHoKinhDoanh->where('id_nganh_kd', $id_nganh_kd);
        }
        //Load list ho kinh doanh
        //$listHoKinhDoanh = $listHoKinhDoanh->paginate($perPage);
        if ($query != null  && isset($query['paginate'])){
            $listHoKinhDoanh = $listHoKinhDoanh->paginate($query['paginate']);
        }
        else{
            $listHoKinhDoanh = $listHoKinhDoanh->paginate(10);
        }
        if ($query != null){
            $listHoKinhDoanh->appends($query);
        }
        $list = [];
        if ($listHoKinhDoanh) {
            foreach ($listHoKinhDoanh as $item) {

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

                $listNganhKinhDoanh = isset($item->getNganhKinhDoanh) ? $item->getNganhKinhDoanh : null;
                $listNganhKinhDoanh_array = '-';
                if ($listNganhKinhDoanh != null) {

                    $listNganhKinhDoanh_array = $listNganhKinhDoanh->ten_nganh;
                }
                $listCho = isset($item->getCho) ? $item->getCho : null;
                $listCho_array = "-";
                if ($listCho != null) {
                    $listCho_array = $listCho;
                }
                $item->ma_sap = isset($sap_array) ? implode($sap_array, ',') : null;
                $item->mat_hang_kinh_doanh = isset($listMatHangKinhDoanh) ? $listMatHangKinhDoanh : null;
                $item->id_nganh_kd = isset($listNganhKinhDoanh_array) ? $listNganhKinhDoanh_array : null;
                $item->id_cho = isset($listCho_array) ? $listCho_array : null;
                $list[] = $item;
            }
        }

        return ['data' => $list, 'paginate' => $listHoKinhDoanh->links() , 'total' => $listHoKinhDoanh->total()];
    }

    public function deleteHoKinhDoanh($id)
    {
        $sap = $this->sap->all();
        $del = $this->hoKinhDoanh->find($id);
        $del->delete_at = '1';
        $del->save();
        if($del)
        {
                $update_sap = $this->sap->getByColumn('id_ho_kinh_doanh', $id);
                //dd($update_sap);
                if(isset($update_sap))
                {
                    foreach ($update_sap as $item_sap)
                    {
                        $item_sap->id_ho_kinh_doanh = null;
                        $item_sap->save();
                    }

                }
        }
        return $del;
    }
    public function createSap($id)
    {
        $listData = $this->hoKinhDoanh->get();
        $cre = $this->sap->find($id);
        $cre->id_ho_kinh_doanh = $listData->id;
        $cre->save();
        return $cre;
    }
    public function exportexcel()
    {

        $listHoKinhDoanh = $this->hoKinhDoanh;
        $listHoKinhDoanh = $listHoKinhDoanh->where('delete_at', 0);
        //Tìm Kiếm Hộ Kinh Doanh
        $list = [];
        if ($listHoKinhDoanh) {
            //dd($listHoKinhDoanh);
            foreach ($listHoKinhDoanh as $item) {

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

                $listNganhKinhDoanh = isset($item->getNganhKinhDoanh) ? $item->getNganhKinhDoanh : null;
                $listNganhKinhDoanh_array = '-';
                if ($listNganhKinhDoanh != null) {

                    $listNganhKinhDoanh_array = $listNganhKinhDoanh->ten_nganh;
                }
                $listCho = isset($item->getCho) ? $item->getCho : null;
                $listCho_array = "-";
                if ($listCho != null) {
                    $listCho_array = $listCho;
                }
                $item->ma_sap = isset($sap_array) ? implode($sap_array, ',') : null;
                $item->mat_hang_kinh_doanh = isset($listMatHangKinhDoanh) ? $listMatHangKinhDoanh : null;
                $item->id_nganh_kd = isset($listNganhKinhDoanh_array) ? $listNganhKinhDoanh_array : null;
                $item->id_cho = isset($listCho_array) ? $listCho_array : null;
                $list[] = $item;
            }
        }

        return ['data' => $list];
    }
}
