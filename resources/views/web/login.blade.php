@extends('web.parent')
@section('title','长城宽带金融--登录')
@section('head_css')
@endsection
@section('content')
    <div id="app">
        <div class="header"><a class="back" href="javascript:void(0);" onclick="history.go(-1)">返回</a>登录</div>
        <form class="login-form">
            <div class="ele">
                <label for="mobile" class="icn icn-phone"></label>
                <input type="text" class="control" id="mobile" placeholder="手机号">
            </div>
            <div class="ele">
                <label for="password" class="icn icn-psw"></label>
                <input type="password" class="control" id="password" placeholder="密码">
            </div>
            <a href="javascript:void(0);" class="btn btn-full btn-big" onclick="login()">登录</a>
            <a href="{{ URL('register')}}" class="reg small">立即注册</a>
            <a href="#" class="forget small">忘记密码?</a>
        </form>
    </div>
@endsection
@section('foot_js')
<script type="text/javascript">
function login(){
    var mobile = $.trim($('#mobile').val());
    var password = $.trim($('#password').val());
    if(mobile == ''){
        alert('请输入手机号');
        return false;
    }
    if(password == ''){
        alert('请输入密码');
        return false;
    }
    if(puppet.checkMobile(mobile) == false){
        alert('请输入正确的手机号');
        return false;
    }
    if(password.length < 6){
        alert('密码不能少于6位');
        return false;
    }
    var url = "{{URL('valid/login')}}";
    var data = {mobile:mobile,password:password};
    var result = puppet.myajax('post',url,data,false);
    if(result.code == true){
        alert(result.message);
        return false;
    }else{
        location.href = '{{ URL('my') }}';
    }
}
</script>
@endsection
