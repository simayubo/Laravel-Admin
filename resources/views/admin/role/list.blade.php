@extends('layouts.admin')
@section('title', '角色列表')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>角色管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin') }}">控制台</a>
                </li>
                <li class="active">
                    <strong>角色列表</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            @permission(('role.add'))
            <h2><a  class="btn btn-primary btn-outline" href="{{ url('admin/role/create') }}">添加角色</a></h2>
            @endpermission
        </div>
    </div>
    <div class="wrapper wrapper-content  animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        @include('flash::message')
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>角色</th>
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
                                    @permission(('role.edit'))
                                    <a href="{{ url('admin/role/'.$item['id'].'/edit') }}" class="btn btn-primary btn-outline btn-xs" title="编辑"><span class="fa fa-edit"></span></a>
                                    @endpermission
                                    @permission(('role.delete'))
                                    @if($item->id == 1)
                                        <a class="btn btn-default btn-outline btn-xs disabled" title="删除"><span class="fa fa-trash"></span></a>
                                        @else
                                        <a onclick="del('{{ $item['id'] }}')" class="btn btn-danger btn-outline btn-xs" title="删除"><form name="delete-{{ $item['id'] }}" action="{{ url('admin/role/'.$item['id'].'') }}" method="post">{!! csrf_field() !!}<input type="hidden" name="_method" value="delete"></form><span class="fa fa-trash"></span></a>
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