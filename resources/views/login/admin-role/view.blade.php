@extends('admin.parent')
@section('title','查看管理员角色')
@section('head_js')
@endsection
@section('head_css')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            查看管理员角色信息
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{URL('admin/role/list')}}">管理员角色列表</a></li>
            <li class="active">查看管理员角色</li>
        </ol>
    </section> 
    <section class="invoice">
        <div class="row">
            <div class="col-xs-6">
                <a href="{{URL('admin/role/list')}}" class="btn btn-default"><i class="fa fa-reply"></i> 返回</a>
                <p class="lead"></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:30%">编号</th>
                                <td>{{ $data['admin_role_id'] }}</td>
                            </tr>
                            <tr>
                                <th>角色名</th>
                                <td>{{ $data['role_name'] }}</td>
                            </tr>
                            <tr>
                                <th>权限</th>
                                <td>{{ implode(',',$data['limit_names']) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('foot_js')
@endsection