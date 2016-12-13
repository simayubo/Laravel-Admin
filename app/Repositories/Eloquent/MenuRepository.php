<?php
namespace App\Repositories\Eloquent;
use App\Models\Menu;
use Cache;
class MenuRepository extends Repository
{
    public function model()
    {
        return Menu::class;
    }

    /**
     * 递归子菜单
     * @param $menus
     * @param int $pid
     * @return array|string
     */
    private function sortMenu($menus, $pid = 0){

        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $k => $v) {
            if ($v['parent_id'] == $pid) {
                $arr[$k] = $v;
                $arr[$k]['child'] = self::sortMenu($menus,$v['id']);
            }
        }
        return $arr;
    }

    /**
     * 排序子菜单，并写入缓存
     * @return array|string
     */
    public function sortMenuSetCache(){
        $menu = $this->model->orderBy('sort', 'desc')->get()->toArray();
        if (!empty($menu)){
            $menus = $this->sortMenu($menu);
            foreach ($menus as &$v) {
                if ($v['child']) {
                    $sort = array_column($v['child'],'sort');
                    array_multisort($sort,SORT_DESC,$v['child']);
                }
            }
            Cache::forever('menuList', $menus);
            return $menus;
        }
        return '';
    }

    /**
     * 获取菜单列表
     * @return array|string
     */
    public function getMenuList(){
        return Cache::get('menuList', $this->sortMenuSetCache());
    }

    /**
     * 更新菜单数据
     * @param $request
     * @return bool
     * @author: simayubo
     */
    public function updateMenu($request){
        $menu = $this->model->find($request->id);
//        dd($request->id);
        if ($menu){
            $isUpdate = $menu->update($request->all());
            if ($isUpdate){
                $this->sortMenuSetCache();
                flash('修改菜单成功！', 'success');
                return true;
            }
            flash('修改菜单失败！', 'error');
            return false;
        }
        abort('404', '找不到菜单数据');
    }

    /**
     * 删除菜单
     * @param $id
     * @return bool
     */
    public function destoryMenu($id){
        $isDelete = $this->model->destroy($id);
        if ($isDelete){
            $this->sortMenuSetCache(); //更新缓存
            flash('菜单删除成功！', 'success');
            return true;
        }
        flash('菜单删除失败！', 'error');
        return false;
    }

}