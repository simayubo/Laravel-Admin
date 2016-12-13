@extends('layouts.admin')
@section('title', '管理员列表')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>管理员管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin') }}">控制台</a>
                </li>
                <li class="active">
                    <strong>管理员列表</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            @permission(('admin.add'))
            <h2><a class="btn btn-primary btn-outline" href="{{ url('admin/admin/create') }}">添加管理员</a></h2>
            @endpermission
        </div>
    </div>
    <div class="wrapper wrapper-content  animated ">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        @include('flash::message')
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>用户ID</th>
                                <th>用户名</th>
                                <th>邮箱</th>
                                <th>权限组</th>
                                <th>添加时间</th>
                                <th width="120">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }} </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role_name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @permission(('admin.edit'))
                                        <a href="{{ url('admin/admin/'.$item['id'].'/edit') }}" class="btn btn-primary btn-outline btn-xs" title="编辑"><span class="fa fa-edit"></span></a>
                                        @endpermission
                                        @permission(('admin.delete'))
                                        @if($item->id == 1)
                                            <a class="btn btn-default btn-outline btn-xs disabled" title="删除"><span class="fa fa-trash"></span></a>
                                        @else
                                            <a onclick="del('{{ $item['id'] }}')" class="btn btn-danger btn-outline btn-xs" title="删除"><form name="delete-{{ $item['id'] }}" action="{{ url('admin/admin/'.$item['id'].'') }}" method="post">{!! csrf_field() !!}<input type="hidden" name="_method" value="delete"></form><span class="fa fa-trash"></span></a>
                                        @endif
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