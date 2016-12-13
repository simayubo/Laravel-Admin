<?php
namespace App\Repositories\Eloquent;
use App\Admin;

class AdminRepository extends Repository {
    public function model()
    {
        return Admin::class;
    }

    /**
     * 获取用户列表
     * @param $request
     * @author: simayubo
     */
    public function getAdminList($request){
        $input = $request->all();
        $where = [];
        if (!empty($input['name'])) $where['name'] = $input['name'];
        if (!empty($input['email'])) $where['email'] = $input['email'];

        $list = $this
            ->model
            ->where($where)
            ->select('admins.*', 'roles.display_name as role_name')
            ->leftJoin('role_user','admins.id','=','role_user.user_id')
            ->leftJoin('roles','roles.id','=','role_user.role_id')
            ->orderBy('admins.id', 'desc')
            ->paginate(15);
        
        return $list;
    }
    public function addAdmin($request){
        $admin = new Admin();
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        if ($admin->fill($input)->save()) {
            //自动更新角色关系
            if ($request->role_id) {
                $admin->role()->sync([$request->role_id]);
            }
            flash('管理员添加成功', 'success');
            return true;
        }
        flash('管理员添加失败', 'error');
        return false;
    }
    /**
     * 删除菜单
     * @param $id
     * @return bool
     */
    public function destoryAdmin($id){
        $isDelete = $this->model->destroy($id);
        if ($isDelete){
            flash('管理员删除成功！', 'success');
            return true;
        }
        flash('管理员删除失败！', 'error');
        return false;
    }

    /**
     * 获取管理员信息
     * @param $id
     * @return mixed
     */
    public function getAdminInfo($id){
        return $this->model->leftJoin('role_user', 'admins.id', '=', 'role_user.user_id')->find($id)->toArray();
    }
    public function updateAdmin($request, $id){
        $admin = $this->model->find($id);
        $input = $request->all();
        if (!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        if ($admin) {
            if ($admin->fill($input)->save()) {
                //自动更新角色关系
                if ($request->role_id) {
                    $admin->role()->sync([$request->role_id]);
                }
                flash('修改管理员成功！', 'success');
                return true;
            }
            flash('修改管理员失败！', 'error');
            return false;
        }
        abort(404);
    }
}