<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade{

    /**
     * 用户仓库门面
     * @return string
     */
    protected static function getFacadeAccessor(){
        return 'UserFacadeRepository';
    }
}