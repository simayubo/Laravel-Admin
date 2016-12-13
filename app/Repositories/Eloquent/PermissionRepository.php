<?php
namespace App\Repositories\Eloquent;
use App\Models\Permission;

/**
 * 权限节点仓库
 * Class PermissionRepository
 * @package App\Repositories\Eloquent
 */
class PermissionRepository extends Repository
{
    public function model()
    {
        return Permission::class;
    }

    /**
     * 获取权限列表
     * @param $request
     * @return mixed
     * @author: simayubo
     */
    public function getList($request){
        $input = $request->all();
        $where = [];
        if (!empty($input['name'])) $where['name'] = $input['name'];
        if (!empty($input['description'])) $where['description'] = $input['description'];

        $list = $this->model->where($where)->orderBy('id', 'desc')->paginate(20);
        return $list;
    }
    public function addPermission($request){
        $permission = new Permission();
        if ($id = $permission->fill($request->all())->save()){
//            $id->role()->sync([$id->id]);
            flash('权限添加成功', 'success');
            return true;
        }else{
            flash('权限添加失败', 'error');
            return false;
        }
    }

    /**
     * 更新权限
     * @param $request
     * @return bool
     * @author: simayubo
     */
    public function updatePermission($request){
        $permission = $this->model->find($request->id);
        if ($permission){
            $isUpdate = $permission->update($request->all());
            if ($isUpdate){
                flash('修改权限成功！', 'success');
                return true;
            }else{
                flash('修改权限失败！', 'error');
                return false;
            }
        }
        abort('404', '找不到该权限数据');
    }
    /**
     * 删除权限
     * @param $id
     * @return bool
     */
    public function destoryPermission($id){
        $permission = $this->model->find($id);
        if ($permission){
            $isDelete = $this->model->destroy($id);
            if ($isDelete){
                flash('删除成功！', 'success');
                return true;
            }else{
                flash('删除失败！', 'error');
            }
        }else{
            flash('权限不存在', 'error');
        }
        return false;
    }
    /**
     * 获取所有权限并分组
     */
    public function findPermissionWithArray()
    {
        $permission = Permission::get();
        $array = [];
        if ($permission) {
            foreach ($permission as $v) {
                array_set($array, $v->name, ['id' => $v->id,'name' => $v->name,'desc' => $v->description,'key' => str_random(10)]);
            }
        }
        return $array;
    }

    function getAllPermissionSetCache(){
        $permission = $this->model->pluck('title');

    }


}