@extends('admin.parent')
@section('title','查看管理员信息')
@section('head_js')
@endsection
@section('head_css')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            查看管理员信息
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{URL('admin/list')}}">管理员列表</a></li>
            <li class="active">查看管理员</li>
        </ol>
    </section> 
    <section class="invoice">
        <div class="row">
            <div class="col-xs-6">
                <a href="{{URL('admin/list')}}" class="btn btn-default"><i class="fa fa-reply"></i> 返回</a>
                <p class="lead"></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:30%">编号</th>
                                <td>{{ $data['admin_id'] }}</td>
                            </tr>
                            <tr>
                                <th>头像</th>
                                <td>{{ $data['head_img'] }}</td>
                            </tr>
                            <tr>
                                <th>账号</th>
                                <td>{{ $data['admin_name'] }}</td>
                            </tr>
                            <tr>
                                <th>真实姓名</th>
                                <td>{{ $data['real_name'] }}</td>
                            </tr>
                            <tr>
                                <th>角色</th>
                                <td>{{ $data['role_name'] }}</td>
                            </tr>
                            <tr>
                                <th>手机号码</th>
                                <td>{{ $data['mobile'] }}</td>
                            </tr>
                            <tr>
                                <th>创建时间</th>
                                <td>{{ date('Y-m-d H:i:s',$data['create_time']) }}</td>
                            </tr>
                            <tr>
                                <th>修改时间</th>
                                <td>{{ date('Y-m-d H:i:s',$data['update_time']) }}</td>
                            </tr>
                            <tr>
                                <th>最后登录时间</th>
                                <td>{{ date('Y-m-d H:i:s',$data['last_login_time']) }}</td>
                            </tr>
                            <tr>
                                <th>状态</th>
                                <td>
                                    @if($data['status'] == 0)
                                        关闭
                                    @elseif($data['status'] == 1)
                                        开启
                                    @else
                                        已删除
                                    @endif    
                                </td>
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