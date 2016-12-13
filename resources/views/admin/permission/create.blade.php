@extends('layouts.admin')
@section('title', '添加权限')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>权限管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin') }}">控制台</a>
                </li>
                <li>
                    <a href="{{ url('admin/permission') }}">权限列表</a>
                </li>
                <li class="active">
                    <strong>添加权限</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="wrapper wrapper-content animated ">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span>添加一个权限节点</span>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" id="form" action="{{ url('admin/permission') }}" method="post">
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
                            <div class="form-group"><label class="col-lg-2 control-label">权限节点</label>
                                <div class="col-lg-9"><input type="text" name="name" value="{{ old('name') }}" class="form-control"><span>* 必须为 xxx.xxx 格式</span>
                                </div>
                            </div>
                            {!! csrf_field() !!}
                            <div class="form-group"><label class="col-lg-2 control-label">权限名称</label>
                                <div class="col-lg-9"><input type="text" name="display_name"  value="{{ old('display_name') }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">权限介绍</label>
                                <div class="col-lg-9"><input type="text" name="description"  value="{{ old('description') }}" class="form-control">
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