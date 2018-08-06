<?php
use Illuminate\Support\Facades\DB;
function get_current_route_name(){
    return Route::currentRouteName();
}
function get_allow_route_name($id){
    return DB::table('user_group')->select('permission')->find($id);
}
function getOld($birthday){
    $strtotime =strtotime(date('d-m-Y')) - strtotime($birthday);
    if ($strtotime >=0){
        $old = ($strtotime / 86400)/ 365;

        return round($old,0);
    }
    return 'N/A';
}

function getSetting($key){
    $value = DB::table('setting')->where('meta_key', $key)->first();
    if ($value != null){
        return $value->meta_value;
    }
    else{
        return '';
    }

}
function getInput($param){
    if (isset($_GET[$param])){
        return $_GET[$param];
    }
    return '';
}
function convertVietNamDateToEn($birthday){
    if (preg_match("/(\d{2})\/(\d{2})\/(\d{4})$/", $birthday,$matches)){
        //full day vn
        $argv = explode('/',$matches[0]);
        if ($argv[0] > 31) {
            return null;
        }
        if ($argv[1] > 12){
            return null;
        }
        $argc['day'] = $argv[2].'-'.$argv[1].'-'.$argv[0];
        $argc['type'] = 'full';
        return $argc;
    }
    if (preg_match("/(\d{2})\/(\d{1})\/(\d{4})$/", $birthday,$matches)){
        //full day vn
        $argv = explode('/',$matches[0]);
        if ($argv[0] > 31) {
            return null;
        }
        if ($argv[1] > 12){
            return null;
        }
        $argc['day'] = $argv[2].'-'.$argv[1].'-'.$argv[0];
        $argc['type'] = 'full';
        return $argc;
    }
    if (preg_match("/(\d{1})\/(\d{2})\/(\d{4})$/", $birthday,$matches)){
        //full day vn
        $argv = explode('/',$matches[0]);
        if ($argv[0] > 31) {
            return null;
        }
        if ($argv[1] > 12){
            return null;
        }
        $argc['day'] = $argv[2].'-'.$argv[1].'-'.$argv[0];
        $argc['type'] = 'full';
        return $argc;
    }
    elseif (preg_match("/(\d{4})\/(\d{2})\/(\d{2})$/", $birthday,$matches)){
        //full day UT

        $argv = explode('/',$matches[0]);
        if ($argv[2] > 31) {
            return null;
        }
        if ($argv[1] > 12){
            return null;
        }

        $argc['day'] =$birthday;
        $argc['type'] = 'full';
        return $argc;
    }
    elseif (preg_match("/(\d{2})\/(\d{4})$/", $birthday,$matches)){
        //m/Y day UT

        $argv = explode('/',$matches[0]);
        if ($argv[0] > 12) {
            return null;
        }

        $argc['day'] = $argv[1].'-'.$argv[0].'-01';
        $argc['type'] = 'month_year';
        return $argc;
    }
    elseif (preg_match("/(\d{4})$/", $birthday,$matches)){
        //Y day UT
        $argc['day'] = $matches[0].'-01-01';
        $argc['type'] = 'year';
        return $argc;
    }

    return null;
}


function message(){
	if(session('message')){
		$session=session('message');
		Session::forget('message');
		
		echo '<p class="alert alert-'.$session['type'].' alert-dismissable message">'.$session['message'].'<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></p>';
	}	
}

function set_flash_message($message,$type="info"){
    session()->put('message', ['type'=>$type,'message'=>$message]);
}

function status_default($code, $type = "icon")
{
    $status = [0 => 'Ẩn', 1 => 'Hiện'];
    $icon = [0 => 'minus-square text-danger', 1 => 'check-square text-success'];
    $title = [0 => 'Ẩn', 1 => 'Hiện'];
    if ($type == 'icon') {
        if (isset($icon[$code])) {
            return '<i class="fa fa-' . $icon[$code] . ' changestatus" title="'.$title[$code].'" style="cursor: pointer;"></i>';
        }
        return;
    }
    if ($type == 'name') {
        if (isset($icon[$code])) {
            return $status[$code];
        }
        return;
    }
    if ($type == 'array') {

        return $status;
    }
}
function getChuoiSap($tenSap)
{
    $tenSap = explode(", ", $tenSap);
    return $tenSap;
}