<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;

class UserController extends Controller
{
    protected $user;
    public function __construct(UserRepository $user)
    {
        $this->middleware('check.permission:user');
        $this->user = $user;
    }

    /**
     * 用户列表
     * @param Request $request
     * @author: simayubo
     */
    public function index(Request $request)
    {
        $user_list = $this->user->getUserList($request);
        return view('admin.user.list')->with(compact('user_list'));
    }

    /**
     * 添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: simayubo
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 编辑用户
     * @param $id
     * @author: simayubo
     */
    public function edit($id)
    {
        $user_info = User::find($id)->toArray();
        return view('admin.user.edit')->with(compact('user_info'));
    }

    /**
     * 更新用户信息
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author: simayubo
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:menus,name,'.$id.'',
            'email' => 'required|email|unique:menus,name,'.$id.'',
        ], [
            'name.required' =>  '用户名不能为空',
            'email.required' =>  '邮箱不能为空',
            'email.unique' =>  '邮箱已存在',
            'email.email' =>  '邮箱格式不正确',
            'name.unique' =>  '用户名已存在'
        ]);

        $this->user->updateUser($request, $id);
        return redirect('admin/user');
    }

    /**
     * 删除用户
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author: simayubo
     */
    public function destroy($id)
    {
        $this->user->destoryUser($id);
        return redirect('admin/user');
    }
}
