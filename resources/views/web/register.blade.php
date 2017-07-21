<!DOCTYPE html>
<html lang="zh-CN">

@extends('web.parent')
@section('title','长城宽带金融--注册')
@section('head_css')
@endsection
@section('content')
    <div id="app">
        <div class="header"><a class="back" href="javascript:void(0);" onclick="history.go(-1)">返回</a>注册</div>
        <form class="login-form">
            <div class="ele">
                <label for="mobile" class="icn icn-phone"></label>
                <input type="text" class="control" id="mobile" placeholder="手机号">
            </div>
            <div class="ele">
                <label for="password" class="icn icn-psw"></label>
                <input type="password" class="control" id="password" placeholder="密码">
            </div>
            <div class="ele">
                <label for="re_password" class="icn icn-psw-ag"></label>
                <input type="password" class="control" id="re_password" placeholder="确认密码">
            </div>
            <a href="javascript:void(0);" class="btn btn-full btn-big" onclick="register()">注册</a>
        </form>
    </div>
@endsection
@section('foot_js')
<script type="text/javascript">
function register(){
    var mobile = $.trim($('#mobile').val());
    var password = $.trim($('#password').val());
    var re_password = $.trim($('#re_password').val());
    if(mobile == ''){
        alert('请输入手机号');
        return false;
    }
    if(password == ''){
        alert('请输入密码');
        return false;
    }
    if(re_password == ''){
        alert('请再次输入密码');
        return false;
    }
    if(puppet.checkMobile(mobile) == false){
        alert('请输入正确的手机号');
        return false;
    }
    if(password.length < 6 || re_password.length < 6){
        alert('密码不能少于6位');
        return false;
    }
    if(password.length != re_password.length){
        alert('两次密码不一致');
        return false;
    }
    var url = "{{URL('valid/user')}}";
    var data = {mobile:mobile};
    var result = puppet.myajax('post',url,data,false);
    if(result.code == true){
        alert(result.message);
        return false;
    }else{
        var re_url = "{{URL('register/save')}}";
        var re_data = {mobile:mobile,password:password,re_password:re_password};
        var re_result = puppet.myajax('post',re_url,re_data,false);
        if(result.code == true){
            alert(result.message);
            return false;
        }else{
            location.href = '{{ URL('my') }}';
        }
    }
}
</script>
@endsection

