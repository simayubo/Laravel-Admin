@extends('layouts.login')
@section('title', '登陆')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
    <div class="form-group">
        <div class="col-md-12 text-center">
            <h2 class="font-bold">登录</h2>
        </div>
    </div>
    {!! csrf_field() !!}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="col-md-12">
            <input type="email" class="form-control" name="email" placeholder="邮箱地址" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="col-md-12">
            <input type="password" class="form-control" placeholder="密码" name="password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
        <div class="col-md-8">
            <input type="password" class="form-control" placeholder="验证码" name="captcha" >
            @if ($errors->has('captcha'))
                <span class="help-block">
                    <strong>{{ $errors->first('captcha') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-4">
           <img src="{{ captcha_src() }}" onclick="this.src='{{ captcha_src() }}'+Math.random()" style='cursor: pointer;'>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 m-b">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> 记住登录
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fa fa-btn fa-sign-in"></i> 登录
            </button>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 text-left inline">
            <a class="btn btn-link" href="{{ url('/register') }}">注册账号</a>
        </div>
        <div class="col-md-6 text-right inline right">
            <a class="btn btn-link" href="{{ url('/password/reset') }}">忘记密码？</a>
        </div>
    </div>
</form>
    @endsection