@extends('layouts.admin')
@section('title', '添加管理员')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>管理员管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin') }}">控制台</a>
                </li>
                <li>
                    <a href="{{ url('admin/admin') }}">管理员列表</a>
                </li>
                <li class="active">
                    <strong>添加管理员</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
    <div class="wrapper wrapper-content animated ">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span>添加一个管理员</span>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" id="form" action="{{ url('admin/admin') }}" method="post">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <p class="font-bold  alert alert-warning m-b-sm" style="display: none" id="error"> </p>
                        {!! csrf_field() !!}
                        <div class="form-group"><label class="col-lg-2 control-label">管理员名称</label>
                            <div class="col-lg-9"><input type="text" name="name"  value="{{ old('name') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">管理员邮箱</label>
                            <div class="col-lg-9"><input type="text" name="email"  value="{{ old('email') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">管理员密码</label>
                            <div class="col-lg-9"><input type="password" name="password"  value="{{ old('password') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">选择角色</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="role_id" >
                                    @foreach($role_list as $v)
                                        <option value="{{ $v['id'] }}">{{ $v['display_name'] }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label"></label>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-primary btn-block" id="sub">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection