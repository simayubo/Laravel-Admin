<?php
namespace App\Repositories\Eloquent;
use App\User;
use Illuminate\Support\Str;

class UserRepository extends Repository {
    public function model()
    {
        return User::class;
    }

    /**
     * 获取用户列表
     * @param $request
     * @author: simayubo
     */
    public function getUserList($request){
        $input = $request->all();
        $where = [];
        if (!empty($input['name'])) $where['name'] = $input['name'];
        if (!empty($input['phone'])) $where['phone'] = $input['phone'];
        if (!empty($input['email'])) $where['email'] = $input['email'];
        if (!empty($input['status'])) $where['status'] = $input['status'];

        $list = $this
            ->model
            ->where($where)
            ->orderBy('id', 'desc')
            ->paginate(15);

        return $list;
    }

    /**
     * 删除用户
     * @param $id
     * @return bool
     * @author: simayubo
     */
    public function destoryUser($id){
        $isDelete = $this->model->destroy($id);
        if ($isDelete){
            flash('会员删除成功！', 'success');
            return true;
        }
        flash('会员删除失败！', 'error');
        return false;
    }

    public function updateUser($request, $id){
        $user = $this->model->find($id);
        $input = $request->all();
        if (!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $input['remember_token'] = Str::random(60);

        if ($user) {
            if ($user->fill($input)->save()) {
                flash('更新用户信息成功！', 'success');
                return true;
            }
            flash('更新用户信息失败！', 'error');
            return false;
        }
        abort(404);
    }
}