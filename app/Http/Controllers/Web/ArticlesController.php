<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     * 列表
     * @return array
     * @author: simayubo
     */
    public function index(){
        return ['action' => 'Articles/index'];
    }

    /**
     * 单个展示
     * @param $id
     * @return array
     * @author: simayubo
     */
    public function show($id){
        return ['action' => 'Articles/show/'.$id];
    }

    /**
     * 添加
     * @return array
     * @author: simayubo
     */
    public function store(){
        return ['action' => 'Articles/store'];
    }

    /**
     * 更新
     * @param $id
     * @return array
     * @author: simayubo
     */
    public function update($id){
        return ['action' => 'Articles/update/'.$id];
    }

    /**
     * 删除
     * @param $id
     * @return array
     * @author: simayubo
     */
    public function destroy($id){
        return ['action' => 'Articles/destroy/'.$id];
    }
}
