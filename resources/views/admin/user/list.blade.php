@extends('layouts.admin')
@section('title', '用户列表')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>用户管理</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('admin') }}">控制台</a>
            </li>
            <li class="active">
                <strong>用户列表</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        @permission(('user.add'))
        <h2><a class="btn btn-primary btn-outline" href="{{ url('admin/user/create') }}">添加用户</a></h2>
        @endpermission
    </div>
</div>
<div class="wrapper wrapper-content  animated">
    {{--<p class="font-bold  alert alert-warning m-b-sm">--}}
        {{--<i class="fa fa-lightbulb-o"></i> &nbsp;非专业人士请勿操作--}}
    {{--</p>--}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    @include('flash::message')
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>昵称</th>
                            <th>邮箱</th>
                            <th>手机号</th>
                            <th>注册时间</th>
                            <th>状态</th>
                            <th width="120">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user_list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if($item->status == 1)
                                    <i style="color: #1AB394;"><span class="fa fa-check"></span></i>
                                    @else
                                    <i style="color: red;"><span class="fa fa-times"></span></i>
                                    @endif
                            </td>
                            <td>
                                @permission(('menu.edit'))
                                <a class="btn btn-primary btn-outline btn-xs edit" href="{{ url('admin/user/'.$item->id.'/edit') }}" title="编辑"> <span class="fa fa-edit"></span> </a>
                                @endpermission
                                @permission(('user.lock'))
                                <a class="btn btn-xs btn-warning btn-outline" title="禁用账号"> <span class="fa fa-lock"> </span> </a>
                                @endpermission
                                @permission(('menu.delete'))
                                <a  onclick="del('{{ $item->id }}')" class="btn btn-danger btn-outline btn-xs edit" title="删除"><form name="delete-{{ $item->id }}" action="{{ url('admin/user/'.$item->id.'') }}" method="post">{!! csrf_field() !!}<input type="hidden" name="_method" value="delete"></form> <span class="fa fa-trash"></span> </a>
                                @endpermission
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection