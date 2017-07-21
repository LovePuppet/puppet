@extends('admin.parent')
@section('title','查看用户')
@section('head_js')
@endsection
@section('head_css')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            查看用户
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{URL('admin/user/list')}}">用户列表</a></li>
            <li class="active">查看用户</li>
        </ol>
    </section> 
    <section class="invoice">
        <div class="row">
            <div class="col-xs-6">
                <a href="{{URL('admin/user/list')}}" class="btn btn-default"><i class="fa fa-reply"></i> 返回</a>
                <p class="lead"></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:30%">编号</th>
                                <td>{{ $data['user_id'] }}</td>
                            </tr>
                            <tr>
                                <th>用户唯一标识</th>
                                <td>{{ $data['token'] }}</td>
                            </tr>
                            <tr>
                                <th>姓名</th>
                                <td>{{ $data['name'] }}</td>
                            </tr>
                            <tr>
                                <th>头像</th>
                                <td><img src="/images/head.jpg"/></td>
                            </tr>
                            <tr>
                                <th>手机号</th>
                                <td>{{ $data['mobile'] }}</td>
                            </tr>
                            <tr>
                                <th>IP</th>
                                <td>{{ $data['ip'] }}</td>
                            </tr>
                            <tr>
                                <th>创建时间</th>
                                <td>{{ date('Y-m-d H:i:s',$data['create_time']) }}</td>
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