<?php

namespace App\Api;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    use Helpers;

    public function returnMsg($success = true, $code = 0, $msg = '', $data = [], $status = '200', $url = ''){
        $array =  [
            'success'   =>  $success,
            'code'      =>  $code,
            'msg'       =>  $msg,
            'data'      =>  $data,
            'status'    =>  $status,
            'url'       =>  $url
        ];

        return $this->response->array($array)->setStatusCode($status);
    }
}
