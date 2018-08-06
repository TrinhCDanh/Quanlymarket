<?php 
namespace App\Repositories\Contracts;

interface ThongkeRepositoryInterface
{
    public function getListSoHoKinhDoanh();
    public function getListKeKhai();
    public function getGiayPhepATTP($option = null);
    public function getSoHoKeKhai($option = null);
    public function getKeKhaiMHKD(Array $request = null);
    public function getKeKhaiMHKDTruyenThong($query = null , $perPage = 10, $currentPage = null );
}