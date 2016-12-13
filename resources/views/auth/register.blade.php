@extends('layouts.login')
@section('title', '注册账号')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        <div class="form-group">
            <div class="col-md-12 text-center">
                <h2 class="font-bold">注册账号</h2>
            </div>
        </div>
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input type="text" placeholder="设置昵称" class="form-control" name="name" value="{{ old('name') }}">

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input type="email" placeholder="设置邮箱地址" class="form-control" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input type="password" placeholder="登录密码" class="form-control" name="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input type="password" placeholder="再次输入密码" class="form-control" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-btn fa-user"></i> 注册
                </button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 text-left inline">
                <a class="btn btn-link" href="{{ url('/login') }}">登录账号</a>
            </div>
        </div>
    </form>
@endsection
