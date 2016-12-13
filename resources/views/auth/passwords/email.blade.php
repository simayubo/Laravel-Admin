@extends('layouts.login')
@section('title', '重置密码')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        <div class="form-group">
            <div class="col-md-12 text-center">
                <h2 class="font-bold">重置密码</h2>
            </div>
        </div>
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <input type="email" class="form-control" placeholder="邮箱地址" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-btn fa-envelope"></i> 发送重置密码邮件
                </button>
            </div>
        </div>
    </form>

@endsection
