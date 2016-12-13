@extends('layouts.admin')
@section('title', '权限列表')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>权限管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin') }}">控制台</a>
                </li>
                <li class="active">
                    <strong>权限列表</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            @permission(('permission.add'))
            <h2><a class="btn btn-primary btn-outline" href="{{ url('admin/permission/create') }}">添加权限</a></h2>
            @endpermission
        </div>
    </div>
    <div class="wrapper wrapper-content  animated">
        <p class="font-bold  alert alert-warning m-b-sm">
           <i class="fa fa-lightbulb-o"></i> &nbsp;非专业人士请勿操作
        </p>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        @include('flash::message')
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>权限节点</th>
                                <th>名称</th>
                                <th>介绍</th>
                                <th width="120">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                <td>{{ $item->id }} </td>
                                <td>{{ $item->name }} </td>
                                <td>{{ $item->display_name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    @permission(('permission.edit'))
                                    <a href="{{ url('admin/permission/'.$item['id'].'/edit') }}" class="btn btn-primary btn-outline btn-xs" title="编辑"><span class="fa fa-edit"></span></a>
                                    @endpermission
                                    @permission(('permission.delete'))
                                    <a onclick="del('{{ $item['id'] }}')" class="btn btn-danger btn-outline btn-xs" title="删除"><form name="delete-{{ $item['id'] }}" action="{{ url('admin/permission/'.$item['id'].'') }}" method="post">{!! csrf_field() !!}<input type="hidden" name="_method" value="delete"></form><span class="fa fa-trash"></span></a>
                                    @endpermission
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $list->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection