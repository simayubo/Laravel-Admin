<?php

namespace App\Api\v1_0\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\BaseController;
use Illuminate\Validation\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends BaseController
{
    /**
     * 注册用户
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');
        $validate = \Validator::make($credentials, [
            'name'  =>  'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ], [
            'name.required' =>  '昵称不能为空',
            'email.required' =>  '邮箱不能为空',
            'name.unique' =>  '昵称已存在',
            'email.unique' =>  '邮箱已存在',
            'password.required' =>  '密码不能为空'
        ]);
        if ($validate->fails()) {
            return $this->returnMsg(false, 422, '数据验证不通过', ['error' => $validate->errors()], 422);
        }

        $credentials['password'] = bcrypt($credentials['password']);
        if ($user = User::create($credentials)){
            $token = JWTAuth::fromUser($user);
            return $this->returnMsg(true, 0, '注册成功', ['token' => $token]);
        }else{
            return $this->returnMsg(false, 101, '注册失败', [], 500);
        }
    }

    /**
     * 登录账号
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        $validate = \Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' =>  '邮箱不能为空',
            'password.required' =>  '密码不能为空'
        ]);
        if ($validate->fails()) {
            return $this->returnMsg(false, 422, '数据验证不通过', ['error' => $validate->errors()], 422);
        }

        $user = User::where('email', $credentials['email'])->first();
        if ($user){
            $is_check = \Hash::check($request->input('password'), $user->password);
            if ($is_check){
                $token = JWTAuth::fromUser($user);
                return $this->returnMsg(true, 0, 'success', ['token' => $token]);
            }
        }
        return $this->returnMsg(false, 1001, '账号或密码错误', [], 200);
    }

    public function getUserInfo(){
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json(compact('user'));

    }


}