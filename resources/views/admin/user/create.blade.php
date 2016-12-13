@extends('layouts.admin')
@section('title', '添加用户')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>用户管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin') }}">控制台</a>
                </li>
                <li>
                    <a href="{{ url('admin/user') }}">菜单列表</a>
                </li>
                <li class="active">
                    <strong>添加用户</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
    <div class="wrapper wrapper-content animated ">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span>添加一个用户</span>
                </div>
                <div class="ibox-content">
                    <p class="font-bold  alert alert-warning m-b-sm">
                    <i class="fa fa-lightbulb-o"></i> &nbsp;别懒了！去前台注册吧！
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection