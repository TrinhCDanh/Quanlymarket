<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function dataSuccess($mes, $data = [])
    {

        return response()->json([
            'success' => true,
            'message' => $mes,
            'data' => $data,
            'code' => 200

        ], 200);
    }
    public function dataError($mes, $data = [],$code = 202)
    {


        return response()->json([
            'success' => false,
            'message' => $mes,
            'data' => $data,
            'code' => $code
        ], 200);
    }
}
