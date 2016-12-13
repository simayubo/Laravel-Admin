<?php
namespace App\Repositories\Presenter;

class MenuPresenter{
    /**
     * 获取select菜单
     * @param $menu
     * @return string
     */
    public function getMenu($menu){
        $option = '<option value="0">顶级菜单</option>';
        if ($menu){
            foreach ($menu as $v) {
                $option .= '<option value="'.$v->id.'">'.$v->name.'</option>';
            }
        }
        return $option;
    }
    public function getMenuEdit($menu, $id){
        $option = '<option value="0">顶级菜单</option>';
        if ($menu){
            foreach ($menu as $v) {
                $selected = '';
                if ($v->id == $id){
                    $selected = 'selected';
                }
                $option .= '<option value="'.$v->id.'" '.$selected.'>'.$v->name.'</option>';
            }
        }
        return $option;
    }

}