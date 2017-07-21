@extends('web.parent')
@section('title','长城宽带金融--我的')
@section('head_css')
@endsection
@section('content')
<div id="app" class="bg-gray">
<div class="header"><a class="back" href="javascript:void(0);" onclick="history.go(-1)">返回</a>我的</div>
<!-- my-info start -->
<div class="my-info">
    <div class="avatar" style="background-image:url({{ asset('/web/images/my_avatar.png') }})"></div>
    <p class="name">@if(empty($userinfo))<a href="{{ URL('login') }}">立即登录</a>@else {{ $userinfo['mobile'] }} @endif</p>
</div>
<!-- my-info end -->
<!-- diviler start -->
<div class="diviler"></div>
<!-- diviler end -->
<!-- menu-list start -->
@if(!empty($userinfo))
<ul class="menu-list">
    <li><a href="javascript:void(0)"><i class="icn icon icn-name"></i>{{ isset($userinfo['name']) ? $userinfo['name'] : '无姓名' }}</a></li>
    <li><a href="javascript:void(0)"><i class="icn icon icn-pos"></i>{{ isset($userinfo['address']) ? $userinfo['address'] : '无地址' }}</a></li>
</ul>
@endif
<!-- menu-list end -->
<!-- diviler start -->
<div class="diviler"></div>
<!-- diviler end -->
<!-- menu-list start -->
<ul class="menu-list">
    <li><a href="#"><i class="icn icon icn-lv"></i>申请记录<i class="icn icn-left"></i></a></li>
    <li><a href="#"><i class="icn icon icn-gift"></i>礼品记录<i class="icn icn-left"></i></a></li>
</ul>
<div class="diviler"></div>
<!-- diviler end -->
<!-- menu-list start -->
<ul class="menu-list">
    <li><a href="#"><i class="icn icon icn-cg"></i>修改密码<i class="icn icn-left"></i></a></li>
</ul>
@include('web.footer')
</div>
@endsection
@section('foot_js')
<script type="text/javascript">
    
</script>
@endsection

