@extends('admin.parent')
@section('title','查看礼品')
@section('head_js')
@endsection
@section('head_css')
<style type="text/css">
    .icon_img_css{
        max-width:60px;
        max-height:60px;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            查看礼品
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{URL('admin/gift/list')}}">礼品列表</a></li>
            <li class="active">查看礼品</li>
        </ol>
    </section> 
    <section class="invoice">
        <div class="row">
            <div class="col-xs-6">
                <a href="{{URL('admin/gift/list')}}" class="btn btn-default"><i class="fa fa-reply"></i> 返回</a>
                <p class="lead"></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:30%">编号</th>
                                <td>{{ $data['gift_id'] }}</td>
                            </tr>
                            <tr>
                                <th>名称</th>
                                <td>{{ $data['title'] }}</td>
                            </tr>
                            <tr>
                                <th>说明</th>
                                <td>{{ $data['explain'] }}</td>
                            </tr>
                            <tr>
                                <th>列表图片</th>
                                <td><img src="{{ env('IMAGE_URL').$data['img'] }}" class="icon_img_css"/></td>
                            </tr>
                            <tr>
                                <th>详情图片</th>
                                <td><img src="{{ env('IMAGE_URL').$data['detail_img'] }}" class="icon_img_css"/></td>
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