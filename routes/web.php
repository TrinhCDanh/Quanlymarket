<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/admin');

});

Auth::routes();
Route::group(['middleware'=>'admin'],function (){
    Route::get('/admin/excel',function (){
        \Excel::create('Filename', function($excel) {
            $excel->sheet('TongHopSoLieuDanCu');
            $excel->setTitle('Our new awesome title');
        })->store('xls',storage_path('excel/exports'))->export('xls');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', 'Admin\DashBoardController@index')->name('admin');
    Route::get('/error', 'Admin\DefaultController@error')->name('default.error');

    Route::get('/admin/user/add', 'Admin\UserController@addUser')->name('admin.user.add');
    Route::get('/admin/user/edit/{id}', 'Admin\UserController@editUser')->name('admin.user.edit');
    Route::get('/admin/user/list', 'Admin\UserController@listUser')->name('admin.user.list');
    Route::post('/admin/user/save', 'Admin\UserController@save')->name('admin.user.save');
    Route::post('/admin/user/update/{id}', 'Admin\UserController@update')->name('admin.user.update');

    Route::get('/admin/user/delete/{id}', 'Admin\UserController@deleteUser')->name('admin.user.delete');

    Route::get('/admin/user/profile/{id}', 'Admin\UserController@getProfile')->name('admin.user.get_profile');
    Route::post('/admin/user/save-profile/{id}', 'Admin\UserController@updateProfile')->name('admin.user.save_profile');

    //ql group user
    Route::get('/admin/group/list', 'Admin\UserGroupController@index')->name('admin.group.list');
    Route::get('/admin/group/add', 'Admin\UserGroupController@form')->name('admin.group.add');
    Route::post('/admin/group/add', 'Admin\UserGroupController@add')->name('admin.group.add');

    Route::get('/admin/group/edit/{id}', 'Admin\UserGroupController@form')->name('admin.group.edit');
    Route::post('/admin/group/edit/{id}', 'Admin\UserGroupController@edit')->name('admin.group.edit');

    Route::get('/admin/group/permission/{id}', 'Admin\UserGroupController@permission')->name('admin.group.permission');
    Route::post('/admin/group/permission/{id}', 'Admin\UserGroupController@save_permission')->name('admin.group.permission');

    Route::get('/admin/group/delete/{id}', 'Admin\UserGroupController@delete')->name('admin.group.delete');


    //Thong ke
    Route::get('admin/thong-ke/tinh-hinh-ke-khai-theo-nhom-nganh','Admin\THKHTheoNhomNganhController@getAll')->name('admin.thong_ke.tinh_hinh_ke_khai_theo_nhom_nganh');
    Route::get('admin/thong-ke/danh-sach-mhkd-tai-cho-truyen-thong','Admin\ThongkeController@index')->name('admin.thong_ke.ke-khai-mhkd-tai-cho-truyen-thong');
    Route::get('admin/thong-ke/danh-sach-mhkd-tai-cho-truyen-thong/export','Admin\ThongkeController@exportthongkett')->name('admin.thong_ke.ke-khai-mhkd-tai-cho-truyen-thong.export');
    \ Route::get('admin/thong-ke/danh-sach-mhkd-tai-cho-truyen-thong/exportPDF','Admin\ThongkeController@exportthongkePDF')->name('admin.thong_ke.ke-khai-mhkd-tai-cho-truyen-thong.exportPDF');
    //danhsachmathangkinhdoanh
    Route::get('admin/danh-sach-mat-hang-kd/list',function(){
        return view ('admin/danh-sach-mat-hang-kd/list');
    });
    //danh sach ho kinh doanh
    Route::get('admin/danh-sach-ho-kd/list','Admin\HoKinhDoanhController@getAll')->name('admin.ho_kinh_doanh.list');
    Route::get('admin/danh-sach-ho-kd/add','Admin\HoKinhDoanhController@add')->name('admin.ho_kinh_doanh.add');
    Route::get('admin/danh-sach-ho-kd/add/{id}','Admin\AjaxController@getListSapfromCho');
    Route::get('admin/danh-sach-ho-kd/edit/{id}','Admin\HoKinhDoanhController@edit')->name('admin.ho_kinh_doanh.edit');
    Route::post('admin/danh-sach-ho-kd/update/{id}','Admin\HoKinhDoanhController@update')->name('admin.ho_kinh_doanh.update');
    Route::get('admin/danh-sach-ho-kd/delete/{id}','Admin\HoKinhDoanhController@deleteHoKinhDoanh')->name('admin.ho_kinh_doanh.delete');
    Route::post('admin/danh-sach-ho-kd/create','Admin\HoKinhDoanhController@store')->name('admin.ho_kinh_doanh.create');
    Route::get('admin/danh-sach-ho-kd/show/{id}','Admin\HoKinhDoanhController@show')->name('admin.ho_kinh_doanh.show');
    Route::get('admin/danh-sach-ho-kd/export/export', 'Admin\HoKinhDoanhController@export')->name('admin.ho_kinh_doanh.export');
    Route::get('admin/danh-sach-ho-kd/export/exportpdf', 'Admin\HoKinhDoanhController@exportPDF')->name('admin.ho_kinh_doanh.exportpdf');
    //Ajax get list form add ho kinh doanh

    Route::get('admin/ajax/list_sap','Admin\AjaxController@getListSap');
    Route::get('admin/ajax/dia_chi','Admin\AjaxController@getDiaChi');
    Route::get('admin/danh-sach-ho-kd/search','Admin\HoKinhDoanhController@search')->name('admin.ho_kinh_doanh.search');
    Route::post('/admin/ajax/upload-file/ho_kinh_doanh','Admin\AjaxController@uploadFile');
   // Route::get('admin/danh-sach-ho-kd/list','Admin\HoKinhDoanhController@getAllCho')->name('admin.ho_kinh_doanh.list');


    //Quan ly sap
    Route::get('admin/sap/list','Admin\SapController@index')->name('admin.sap.list');
    Route::get('admin/sap/add','Admin\SapController@create')->name('admin.sap.create');
    Route::post('admin/sap/save','Admin\SapController@store')->name('admin.sap.store');
    Route::get('admin/sap/show/{id}','Admin\SapController@show')->name('admin.sap.show');
    Route::get('admin/sap/edit/{id}','Admin\SapController@edit')->name('admin.sap.edit');
    Route::post('admin/sap/update/{id}','Admin\SapController@update')->name('admin.sap.update');
    Route::get('admin/sap/delete/{id}','Admin\SapController@deleteSap')->name('admin.sap.destroy');
    Route::get('admin/sap/deleteHoKinhDoanh/{id}','Admin\SapController@deleteHoKinhDoanh')->name('admin.sap.destroyHoKinhDoanh');

    //Quan ly co so cung cap
    Route::get('admin/co-so-cung-cap/list','Admin\CoSoCungCapController@index')->name('admin.co_so_cung_cap.list');
    Route::get('admin/co-so-cung-cap/add','Admin\CoSoCungCapController@create')->name('admin.co_so_cung_cap.create');
    Route::post('admin/co-so-cung-cap/save','Admin\CoSoCungCapController@store')->name('admin.co_so_cung_cap.store');
    Route::get('admin/co-so-cung-cap/show/{id}','Admin\CoSoCungCapController@show')->name('admin.co_so_cung_cap.show');
    Route::get('admin/co-so-cung-cap/edit/{id}','Admin\CoSoCungCapController@edit')->name('admin.co_so_cung_cap.edit');
    Route::post('admin/co-so-cung-cap/update/{id}','Admin\CoSoCungCapController@update')->name('admin.co_so_cung_cap.update');
    Route::get('admin/co-so-cung-cap/delete/{id}','Admin\CoSoCungCapController@delete')->name('admin.co_so_cung_cap.destroy');

    //Quan ly nganh kinh doanh
    Route::get('admin/nganh-kinh-doanh/list','Admin\NganhKinhDoanhController@index')->name('admin.nganh_kinh_doanh.list');
    Route::get('admin/nganh-kinh-doanh/add','Admin\NganhKinhDoanhController@create')->name('admin.nganh_kinh_doanh.create');
    Route::post('admin/nganh-kinh-doanh/save','Admin\NganhKinhDoanhController@store')->name('admin.nganh_kinh_doanh.store');
    Route::get('admin/nganh-kinh-doanh/show/{id}','Admin\NganhKinhDoanhController@show')->name('admin.nganh_kinh_doanh.show');
    Route::get('admin/nganh-kinh-doanh/edit/{id}','Admin\NganhKinhDoanhController@edit')->name('admin.nganh_kinh_doanh.edit');
    Route::post('admin/nganh-kinh-doanh/update/{id}','Admin\NganhKinhDoanhController@update')->name('admin.nganh_kinh_doanh.update');
    Route::get('admin/nganh-kinh-doanh/delete/{id}','Admin\NganhKinhDoanhController@delete')->name('admin.nganh_kinh_doanh.destroy');


    //Quan ly cho
    Route::get('admin/cho/list','Admin\ChoController@getAll')->name('admin.cho.list');
    Route::get('admin/cho/add','Admin\ChoController@edit')->name('admin.cho.add');
    Route::get('admin/cho/edit/{id?}','Admin\ChoController@edit')->name('admin.cho.edit');
    Route::post('admin/cho/update/{id?}','Admin\ChoController@update')->name('admin.cho.update');
    Route::get('admin/cho/delete/{id}','Admin\ChoController@delete')->name('admin.cho.delete');

    //thong ke
    //thong ke mhkd tai cho
    Route::get('admin/thong-ke/thong-ke-mhkd', 'Admin\ThongkeMHKDController@index')->name('admin.thongke.mhkd.list');
    Route::get('admin/thong-ke/thong-ke-mhkd/export', 'Admin\ThongkeMHKDController@export')->name('admin.thongke.mhkd.export');
    Route::get('admin/thong-ke/thong-ke-mhkd/exportpdf', 'Admin\ThongkeMHKDController@exportPDF')->name('admin.thongke.mhkd.exportpdf');
    //quan ly ho so attp
    Route::get('admin/thong-ke/ho-so-ql-attp','Admin\HosoquanlyATTPController@index')->name('admin.quanly.hoso.attp');
    Route::get('admin/thong-ke/ho-so-ql-attp/export/','Admin\HosoquanlyATTPController@export')->name('admin.quanly.hoso.attp.export');
    // Route::get('admin/thong-ke/ho-so-ql-attp/search','Admin\HosoquanlyATTPController@search')->name('admin.quanly-hoso-attp.search');


    //ql mat hang kinh doanh
    Route::get('admin/ho-kinh-doanh/list','Admin\HoKinhDoanhListController@index')->name('admin.ho_kd.list');
    Route::get('admin/mat-hang-kinh-doanh/list/{id}','Admin\MatHangKinhDoanhController@index')->name('admin.mat_hang_kinh_doanh.list');
    Route::get('admin/mat-hang-kinh-doanh/add/{id_ho}','Admin\MatHangKinhDoanhController@form')->name('admin.mat_hang_kinh_doanh.create');
    Route::post('admin/mat-hang-kinh-doanh/add/{id_ho}','Admin\MatHangKinhDoanhController@save')->name('admin.mat_hang_kinh_doanh.create');
    Route::get('admin/mat-hang-kinh-doanh/edit/{id_ho}/{id}','Admin\MatHangKinhDoanhController@form')->name('admin.mat_hang_kinh_doanh.edit');
    Route::post('admin/mat-hang-kinh-doanh/edit/{id_ho}/{id}','Admin\MatHangKinhDoanhController@save')->name('admin.mat_hang_kinh_doanh.edit');
    Route::get('admin/mat-hang-kinh-doanh/delete/{id}','Admin\MatHangKinhDoanhController@delete')->name('admin.mat_hang_kinh_doanh.delete');
    Route::get('admin/mat-hang-kinh-doanh/export/{id_ho}', 'Admin\MatHangKinhDoanhController@export')->name('admin.mat_hang_kinh_doanh.export');

    //Quan ly ATTP
    Route::get('admin/ATTP/list','Admin\ATTPController@getAll')->name('admin.ATTP.list');


    //Quan ly Don vi tinh
    Route::get('admin/don-vi-tinh/list','Admin\DonViTinhController@index')->name('admin.don-vi-tinh.list');
    Route::get('admin/don-vi-tinh/add','Admin\DonViTinhController@create')->name('admin.don-vi-tinh.create');
    Route::post('admin/don-vi-tinh/save','Admin\DonViTinhController@store')->name('admin.don-vi-tinh.store');
    Route::get('admin/don-vi-tinh/show/{id}','Admin\DonViTinhController@show')->name('admin.don-vi-tinh.show');
    Route::get('admin/don-vi-tinh/edit/{id}','Admin\DonViTinhController@edit')->name('admin.don-vi-tinh.edit');
    Route::post('admin/don-vi-tinh/update/{id}','Admin\DonViTinhController@update')->name('admin.don-vi-tinh.update');
    Route::get('admin/don-vi-tinh/delete/{id}','Admin\DonViTinhController@delete')->name('admin.don-vi-tinh.destroy');

    //import don vi tinh
    Route::post('admin/ajax/don-vi-tinh/import','Admin\AjaxController@importDonViTinh');

    //import co so cung cap
    Route::post('admin/ajax/co-so-cung-cap/import','Admin\AjaxController@importCoSoCungCap');

     //import sạp
    Route::post('admin/ajax/sap/import','Admin\AjaxController@importSap');

    //import Hộ kinh doanh
    Route::post('admin/ajax/ho-kinh-doanh/import','Admin\AjaxController@importHoKinhDoanh');

    Route::get('admin/ajax/ke-khai-mhkd-tai-cho-truyen-thong/sap','Admin\AjaxController@getSap');
});

