<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        $routeName = \Route::currentRouteName();

        $permission = '';
        switch ($routeName) {
            case $model.'.index':
                $permission = $model.'.list'; break;
            case $model.'.create':
                $permission = $model.'.add'; break;
            case $model.'.store':
                $permission = $model.'.add'; break;
            case $model.'.edit':
                $permission = $model.'.edit'; break;
            case $model.'.update':
                $permission = $model.'.edit'; break;
                break;
            case $model.'.destroy':
                $permission = $model.'.delete'; break;
                break;
            default:
                $permission = '';
                break;
        }
        if (!$request->user('admin')->can($permission)) {
//            dd('没有权限');
        }

        return $next($request);
    }
}
