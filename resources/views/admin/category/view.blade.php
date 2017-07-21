@extends('admin.parent')
@section('title','查看分类')
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
            查看分类
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="{{URL('admin/category/list')}}">分类列表</a></li>
            <li class="active">查看分类</li>
        </ol>
    </section> 
    <section class="invoice">
        <div class="row">
            <div class="col-xs-6">
                <a href="{{URL('admin/category/list')}}" class="btn btn-default"><i class="fa fa-reply"></i> 返回</a>
                <p class="lead"></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:30%">编号</th>
                                <td>{{ $data['category_id'] }}</td>
                            </tr>
                            <tr>
                                <th>上级分类名</th>
                                <td>{{ $data['fid_name'] }}</td>
                            </tr>
                            <tr>
                                <th>分类图标</th>
                                <td><img src="{{ env('IMAGE_URL').$data['icon_url'] }}" class="icon_img_css"/></td>
                            </tr>
                            <tr>
                                <th>名称</th>
                                <td>{{ $data['category_name'] }}</td>
                            </tr>
                            <tr>
                                <th>说明</th>
                                <td>{{ $data['explain'] }}</td>
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