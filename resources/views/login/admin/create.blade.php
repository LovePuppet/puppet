@extends('admin.parent')
@section('title','新增管理员')
@section('head_js')
@endsection
@section('head_css')
@endsection
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <h1>
        新增管理员
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li><a href="{{URL('admin/list')}}">管理员列表</a></li>
        <li class="active">新增管理员</li>
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
                <form role="form" action="{{URL('admin/create/save')}}" method="post" id="admin_create_form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username">账号</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="请输入账号" required>
                        </div>
                        <div class="form-group">
                            <label for="password">密码</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="请输入用户密码" required>
                        </div>
                        <div class="form-group">
                            <label for="realname">真实姓名</label>
                            <input type="text" class="form-control" id="realname" name="realname" placeholder="真实姓名">
                        </div>
                        <div class="form-group">
                            <label for="role_id">角色</label>
                            <select class="form-control" name="role_id">
                                @foreach($data as $role)
                                <option value="{{ $role['admin_role_id'] }}">{{ $role['role_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mobile">电话号码</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="电话号码">
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
$(document).ready(function(){
    $('#admin_create_form').submit(function(){
        var username  =  $.trim($("#username").val());
        var password  =  $.trim($("#password").val());
        var mobile  =  $.trim($("#mobile").val());
        if(username == ''){
            $('#show_error_msg').html('请输入账号');
            $("#login-box-msg").show();
            return false;
        }
        if(password == ''){
            $('#show_error_msg').html('请输入密码');
            $("#login-box-msg").show();
            return false;
        }
        if(password.length <6) {
            $('#show_error_msg').html('密码不能少于6位');
            $("#login-box-msg").show();
            return false;
        }
        if(!puppet.checkusrandpwd(password)){
            $("#show_error_msg").html("密码含有非法字符");
            $("#login-box-msg").show();
            return false;
        }
        if(mobile != '' && !puppet.checkMobile(mobile)){
            $("#show_error_msg").html("手机号有误");
            $("#login-box-msg").show();
            return false;
        }
        var url = "{{URL('admin/valid/adminname')}}";
        var data = {username:username};
        var is_login = puppet.myajax('post',url,data,false);
        if(is_login.code == true){
            $("#show_error_msg").html(is_login.message);
            $("#login-box-msg").show();
            return false;
        }
    })
})
</script>
@endsection