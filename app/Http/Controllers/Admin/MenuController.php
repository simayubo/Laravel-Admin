<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\MenuRepository;

class MenuController extends Controller
{
    private $menu;

    public function __construct(MenuRepository $menu){
        $this->middleware('check.permission:menu');
        $this->menu = $menu;
    }
    /**
     * 展示
     */
    public function index(){
        $list = $this->menu->getMenuList();

        return view('admin.menu.list')->with(compact('list'));
    }
    /**
     * 添加
     */
    public function create(){
        $menu = $this->menu->findByField('parent_id', 0);
        return view('admin.menu.create')->with(compact('menu'));
    }
    /**
     * 添加
     * @param MenuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MenuRequest $request){
        if ($this->menu->create($request->all())){
            $this->menu->sortMenuSetCache();
            flash('菜单添加成功', 'success');
        }else{
            flash('菜单添加失败', 'error');
        }
        return redirect('admin/menu');
    }

    /**
     * 编辑
     * @param $id
     */
    public function edit($id){
        $menu_info = $this->menu->find($id)->toArray();
        $menu = $this->menu->findByField('parent_id', 0);
        return view('admin.menu.edit')->with(compact('menu', 'menu_info'));
    }

    /**
     * 更新菜单
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author: simayubo
     */
    public function update(MenuRequest $request){
        $this->menu->updateMenu($request);
        return redirect('admin/menu');
    }

    /**
     * 删除菜单
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id){
        $this->menu->destoryMenu($id);
        return redirect('admin/menu');
    }

}
