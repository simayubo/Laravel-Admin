@extends('layouts.admin')
@section('title', '控制台')

@section('content')
    @inject('menus', 'App\Repositories\Presenter\MenuPresenter')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>菜单管理</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('admin') }}">控制台</a>
            </li>
            <li class="active">
                <strong>菜单列表</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        @permission(('menu.add'))
        <h2><a class="btn btn-primary btn-outline" href="{{ url('admin/menu/create') }}">添加菜单</a></h2>
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
                            <th>菜单名</th>
                            <th>链接</th>
                            <th>高亮</th>
                            <th>权限</th>
                            <th>排序</th>
                            <th width="120">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                        <tr>
                            <td><span class="{{ $item['icon'] }}"></span> &nbsp;{{ $item['name'] }} </td>
                            <td>{{ $item['url'] }}</td>
                            <td>{{ $item['heightlight_url'] }}</td>
                            <td>{{ $item['slug'] }}</td>
                            <td>{{ $item['sort'] }}</td>
                            <td>
                                @permission(('menu.edit'))
                                <a class="btn btn-primary btn-outline btn-xs edit" href="{{ url('admin/menu/'.$item['id'].'/edit') }}" title="编辑"><span class="fa fa-edit"></span></a>
                                @endpermission
                                @permission(('menu.delete'))
                                <a  onclick="del('{{ $item['id'] }}')" class="btn btn-danger btn-outline btn-xs edit" title="删除"><form name="delete-{{ $item['id'] }}" action="{{ url('admin/menu/'.$item['id'].'') }}" method="post">{!! csrf_field() !!}<input type="hidden" name="_method" value="delete"></form><span class="fa fa-trash"></span></a>
                                @endpermission
                            </td>
                        </tr>
                            @foreach($item['child'] as $_item)
                            <tr>
                                <td>  &nbsp; ┠  &nbsp; {{ $_item['name'] }} </td>
                                <td>{{ $_item['url'] }}</td>
                                <td>{{ $_item['heightlight_url'] }}</td>
                                <td>{{ $_item['slug'] }}</td>
                                <td>{{ $_item['sort'] }}</td>
                                <td>
                                    @permission(('menu.edit'))
                                    <a class="btn btn-primary btn-outline btn-xs edit" href="{{ url('admin/menu/'.$_item['id'].'/edit') }}" title="编辑"><span class="fa fa-edit"></span></a>
                                    @endpermission
                                    @permission(('menu.delete'))
                                    <a  onclick="del('{{ $_item['id'] }}')" class="btn btn-danger btn-outline btn-xs edit" title="删除"><form name="delete-{{ $_item['id'] }}" action="{{ url('admin/menu/'.$_item['id'].'') }}" method="post">{!! csrf_field() !!}<input type="hidden" name="_method" value="delete"></form><span class="fa fa-trash"></span> </a>
                                    @endpermission
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection