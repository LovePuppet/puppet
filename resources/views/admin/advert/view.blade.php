@extends('admin.parent')
@section('title','查看广告')
@section('head_js')
@endsection
@section('head_css')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            查看广告
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{URL('admin/advert/list')}}">广告列表</a></li>
            <li class="active">查看广告</li>
        </ol>
    </section> 
    <section class="invoice">
        <div class="row">
            <div class="col-xs-6">
                <a href="{{URL('admin/advert/list')}}" class="btn btn-default"><i class="fa fa-reply"></i> 返回</a>
                <p class="lead"></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:30%">编号</th>
                                <td>{{ $data['advert_id'] }}</td>
                            </tr>
                            <tr>
                                <th>标题</th>
                                <td>{{ $data['title'] }}</td>
                            </tr>
                            <tr>
                                <th>最高金额</th>
                                <td>{{ $data['max_amount'] }}</td>
                            </tr>
                            <tr>
                                <th>信用等级</th>
                                <td>{{ $data['credit_rating'] }}</td>
                            </tr>
                            <tr>
                                <th>特权</th>
                                <td>{{ $data['privilege'] }}</td>
                            </tr>
                            <tr>
                                <th>贷款成功率</th>
                                <td>{{ $data['success_rate'] }}</td>
                            </tr>
                            <tr>
                                <th>排序</th>
                                <td>{{ $data['sort'] }}</td>
                            </tr>
                            <tr>
                                <th>创建时间</th>
                                <td>{{ date('Y-m-d H:i:s',$data['create_time']) }}</td>
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