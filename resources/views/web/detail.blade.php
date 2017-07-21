@extends('web.parent')
@section('title','长城宽带金融--详情')
@section('head_css')
@endsection
@section('content')
<div id="app">
    <div class="header"><a class="back" href="javascript:void(0);" onclick="history.go(-1)">返回</a>详情</div>
    <!-- detail-avatar start -->
    <div class="detail-avatar">
        <img src="{{ env('IMAGE_URL').$data['detail_img'] }}">
    </div>
    <!-- detail-avatar end -->
    <div class="fixed-btn-fix"></div>
    <div class="btn btn-full btn-big" val="{{ $data['product_id'] }}" t_val="{{ $data['title'] }}"
         onclick="application(this)" style="margin-bottom:50px;margin-left:8%;">立即申请</div>
    @include('web.footer')
</div>
<div class="cover" style="display:none;">
    <div class="inner">
        <div class="title">请填写您的信息</div>
        <div class="ele ele-pop">
            <input type="text" class="control" id="name" placeholder="您的姓名" 
            @if(isset($userinfo['name']) && !empty($userinfo['name'])) value="{{ $userinfo['name'] }}" @endif>
        </div>
        <div class="ele ele-pop">
            <input type="text" class="control" id="mobile" placeholder="您的手机号"
            @if(isset($userinfo['mobile']) && !empty($userinfo['mobile'])) value="{{ $userinfo['mobile'] }}" @endif>
        </div>
        <div class="ele ele-pop">
            <input type="text" class="control" id="address" placeholder="您的地址"
            @if(isset($userinfo['address']) && !empty($userinfo['address'])) value="{{ $userinfo['address'] }}" @endif>
        </div>
        <a href="javascript:void(0)" class="btn btn-full btn-normal" onclick="submit_app()">提 交</a>
    </div>
</div>
@endsection
@section('foot_js')
<script type="text/javascript">
var type = 2;
var application_id = 0;
var application_title = '';
function application(obj){
    $('.cover').show();
    application_id = $(obj).attr('val');
    application_title = $(obj).attr('t_val');
}
function submit_app(){
    var name = $.trim($('#name').val());
    var mobile = $.trim($('#mobile').val());
    var address = $.trim($('#address').val());
    if(name == ''){
        alert('请填写您的姓名');
        return false;
    }
    if(mobile == ''){
        alert('请填写您的手机号');
        return false;
    }
    if(puppet.checkMobile(mobile) == false){
        alert('您的手机号填写有误');
        return false;
    }
    var url = "{{URL('application/submit')}}";
    var data = {name:name,mobile:mobile,address:address,type:type,application_id:application_id,application_title:application_title};
    var result = puppet.myajax('post',url,data,false);
    if(result.code == true){
        alert(result.message);
        return false;
    }else{
        alert('提交成功');
        $('.cover').hide();
    }
}
</script>
@endsection
