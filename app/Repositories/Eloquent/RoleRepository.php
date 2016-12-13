<?php

namespace App\Repositories\Eloquent;
use App\Models\Role;

class RoleRepository extends Repository {

    public function model()
    {
        return Role::class;
    }

    /**
     * 获取列表
     * @param $request
     * @return mixed
     * @author: simayubo
     */
    public function getRoleList($request){
        $input = $request->all();
        $where = [];
        if (!empty($input['name'])) $where['name'] = $input['name'];
        if (!empty($input['description'])) $where['description'] = $input['description'];

        $list = $this->model->where($where)->paginate(20);
        return $list;
    }

    /**
     * 更新角色
     * @param $request
     * @return bool
     * @author: simayubo
     */
    public function updateRole($request, $id){
        $role = Role::find($id);
        if ($role) {
            if ($role->fill($request->all())->save()) {
                //自动更新角色权限关系
                if ($request->permission) {
                    $role->permission()->sync($request->permission);
                }else{
                    $role->permission()->sync([]);
                }
                flash('修改角色成功！', 'success');
                return true;
            }
            flash('修改角色失败！', 'error');
            return false;
        }
        abort(404);
    }

    /**
     * 添加角色
     * @param $request
     * @return bool
     * @author: simayubo
     */
    public function addRole($request){
        $role = new Role;
        if ($role->fill($request->all())->save()) {
            //自动更新角色权限关系
            if ($request->permission) {
                $role->permission()->sync($request->permission);
            }
            flash('角色添加成功', 'success');
            return true;
        }
        flash('角色添加失败', 'error');
        return false;
    }

    /**
     * 获取权限，且加上状态
     * @param $permission
     * @param $id
     * @return array
     * @author: simayubo
     */
    public function getEditCheckedStatus($permission, $id){
        $permissions = $permission->findPermissionWithArray();
        $permission = \DB::table('permission_role')->where('role_id', $id)->pluck('permission_id')->toArray();

        $list = array();
        foreach ($permissions as $k => $v) {
            $_on = 'no';
            $_permissions = $v;
            foreach ($v as $_k => $_v){
                if (in_array($_v['id'], $permission)){
                    $_on = 'yes';
                    $_permissions[$_k]['active'] = 'yes';
                }else{
                    $_permissions[$_k]['active'] = 'no';
                }
            }
            $list[$k] = [
                'active'    =>  $_on,
                'list'      =>  $_permissions
            ];
        }
        return $list;
    }

    /**
     * 删除角色
     * @param $id
     * @return bool
     * @author: simayubo
     */
    public function destroy($id){
        $is_delete = Role::whereId($id)->delete();
        if ($is_delete) {
            flash('删除成功！', 'success');
            return true;
        }
        flash('删除失败！', 'error');
        return false;
    }
}