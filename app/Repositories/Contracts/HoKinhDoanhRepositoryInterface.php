<?php

namespace App\Repositories\Contracts;

interface HoKinhDoanhRepositoryInterface
{
    public function get($id, $columns = array('*'));

    public function all($columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function save(array $data);

    public function update(array $data, $id);

    public function getByColumn($column, $value);

    public function getListByColumn($column, $value, $columnsSelected = array('*'));

    public function delete($id);

    public function deleteMulti(array $data);

    public function getListThongKeTheoNhomNganh($perPage = 15, $currentPage = null, $query = null);

    public function getListHoKinhDoanh( $query = null, $perPage = 15, $currentPage = null);

    public function deleteHoKinhDoanh($id);

    public function createSap($id);

    public  function exportexcel();
}
