@extends('layouts.login')
@section('title', '设置密码')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
        <div class="form-group">
            <div class="col-md-12 text-center">
                <h2 class="font-bold">设置密码</h2>
            </div>
        </div>
        {!! csrf_field() !!}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

            <div class="col-md-12">
                <input type="email" class="form-control" placeholder="邮箱地址" name="email" value="{{ $email or old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

            <div class="col-md-12">
                <input type="password" placeholder="新密码" class="form-control" name="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input type="password" placeholder="确认新密码" class="form-control" name="password_confirmation">

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
                    <i class="fa fa-btn fa-refresh"></i> 重置密码
                </button>
            </div>
        </div>
    </form>

@endsection
