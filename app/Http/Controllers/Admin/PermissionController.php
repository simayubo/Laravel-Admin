<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\PermissionRepository;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    private $permission;
    public function __construct(PermissionRepository $permission)
    {
        $this->middleware('check.permission:permission');
        $this->permission = $permission;
    }

    /**
     * 权限列表
     * @param Request $request
     * @author: simayubo
     */
    public function index(Request $request){

        $list = $this->permission->getList($request);
        return view('admin.permission.list')->with(compact('list'));
    }

    /**
     * 添加权限
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: simayubo
     */
    public function create(){

        return view('admin.permission.create');
    }

    /**
     * 验证添加权限
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author: simayubo
     */
    public function store(PermissionRequest $request){
        $this->permission->addPermission($request);
        return redirect('admin/permission');
    }

    /**
     * 编辑
     * @param $id
     * @author: simayubo
     */
    public function edit($id){
        $permission = $this->permission->find($id)->toArray();
        return view('admin.permission.edit')->with(compact('permission'));
    }

    /**
     * 保存编辑数据
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author: simayubo
     *
     */
    public function update(PermissionRequest $request){
        $this->permission->updatePermission($request);
        return redirect('admin/permission');
    }

    /**
     * 删除权限
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author: simayubo
     */
    public function destroy($id){
        $this->permission->destoryPermission($id);
        return redirect('admin/permission');

    }

}
