@extends('admin.parent')
@section('title','新增广告')
@section('head_js')
@endsection
@section('head_css')
@endsection
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <h1>
        新增广告
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li><a href="{{URL('admin/advert/list')}}">广告列表</a></li>
        <li class="active">新增广告</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!--
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>
                </div>
                -->
                <!-- /.box-header -->
                <!-- form start -->
                @if(Session::has('error_msg'))
                <div class="callout callout-danger" id="login-box-msg" style="display:block;">
                    <h4 id="show_error_msg">{{ session('error_msg') }}</h4>
                </div>
                @else
                <div class="callout callout-danger" id="login-box-msg" style="display:none;">
                    <h4 id="show_error_msg"></h4>
                </div>
                @endif
                <form role="form" action="{{URL('admin/advert/create/save')}}" method="post" id="data_form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">标题<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="请输入标题" required>
                        </div>
                        <div class="form-group">
                            <label for="max_amount">最高额度<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="max_amount" name="max_amount" placeholder="请输入最高额度" required>
                        </div>
                        <div class="form-group">
                            <label for="credit_rating">信用等级<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="credit_rating" name="credit_rating" placeholder="请输入信用等级" required>
                        </div>
                        <div class="form-group">
                            <label for="privilege">解锁特权<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="privilege" name="privilege" placeholder="请输入特权" required>
                        </div>
                        <div class="form-group">
                            <label for="success_rate">贷款成功率<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="success_rate" name="success_rate" placeholder="请输入贷款成功率" required>
                        </div>
                        <div class="form-group">
                            <label for="sort">排序</label>
                            <input type="text" class="form-control" id="sort" name="sort">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">提 交</button>
                        <button type="button" class="btn btn-danger pull-right" onclick="history.go(-1)">取 消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
@section('foot_js')
<script src="{{ asset('/js/tools.js') }}"></script>
<script type="text/javascript">
var image_domain = '{{ env('IMAGE_URL') }}';
$(document).ready(function(){
    $('#data_form').submit(function(){
        var title  =  $.trim($("#title").val());
        if(title == ''){
            $('#show_error_msg').html('请输入标题');
            $("#login-box-msg").show();
            return false;
        }
    })
})
</script>
@endsection