@extends('admin.layout')

@section('title')
    角色列表
@endsection

@section('content')

<link rel="stylesheet" type="text/css" href="/css/tree_style.css" />

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        角色列表
        <small>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-dashboard">
                </i>
                系统管理
            </a>
        </li>
        <li class="active">
            角色列表
        </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    系统用户角色
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped " id="data_table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th class="center">
                                    角色
                                </th>
                                <th class="center">
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admin_roles as $k => $item)
                            <tr>
                                <td>
                                    {{ $item['role_id'] }}
                                </td>
                                <td>
                                    {{ $item['role_name'] }}
                                </td>
                                <td class="center">
                                    @if($login_admin->hasPermission('set_role_permission'))
                                        <a class="btn btn-warning btn-xs btn-set" href="/role/permission?role_id={{ $item['role_id'] }}" type="button">
                                            分配权限
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    CRM客户端 用户角色
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped " id="data_table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th class="center">
                                    角色
                                </th>
                                <th class="center">
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($client_roles as $k => $item)
                            <tr>
                                <td>
                                    {{ $item['role_id'] }}
                                </td>
                                <td>
                                    {{ $item['role_name'] }}
                                </td>
                                <td class="center">
                                    @if($login_admin->hasPermission('set_role_permission'))
                                        <a class="btn btn-warning btn-xs btn-set" href="/role/clientPermission?role_id={{ $item['role_id'] }}" type="button">
                                            分配权限
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

@endsection

@section('script')

@endsection
