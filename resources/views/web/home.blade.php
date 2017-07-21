@extends('web.parent')
@section('title','长城宽带金融--首页')
@section('head_css')
@endsection
@section('content')
<div id="app">
<div class="header"><a class="back" href="javascript:void(0);" onclick="history.go(-1)">返回</a>首页</div>
<!-- tabs-list start -->
@if(!empty($categories))
<ul class="tabs-list">
    @foreach($categories as $category)
    <li>
        <a href="{{ URL('list').'/'.$category['category_id'] }}">
            <div class="avatar xyk" style="background-image:url({{ env('IMAGE_URL').$category['icon_url'] }})"></div>
            <p class="dec">{{ $category['category_name'] }}</p>
        </a>
    </li>
    @endforeach
</ul>
@endif
<!-- tabs-list end  -->
@if(!empty($adverts))
<!-- diviler start -->
<div class="diviler"></div>
<!-- diviler end -->
<!-- m-ed start -->
@foreach($adverts as $advert)
<div class="m-ed">
    <div class="sign">
        <p class="text small">信用等级</p>
        <p class="text small score">{{ $advert['credit_rating'] }}</p>
    </div>
    <div class="content">
        <p class="title">{{ $advert['title'] }}</p>
        <p class="title price">最高可达<span class="amout">{{ $advert['max_amount'] }}</span>元</p>
        <div class="tq">
            <div class="item">
                <i class="icn icn-hg"></i><span class="small">已解锁特权{{ $advert['privilege'] }}个</span>
            </div>
            <div class="item">
                <i class="icn icn-money"></i><span class="small">贷款成功率{{ $advert['success_rate'] }}%</span>
            </div>
        </div>
        <div class="btns">
            @if(empty($userinfo))
            <a href="{{ URL('login') }}" class="btn">测测我的额度</a>
            @else
            <a href="javascript:void(0)" class="btn">我的额度{{ $advert['max_amount']/2 }}</a>
            @endif
            <a href="javascript:void(0)" class="btn btn-full" val="{{ $advert['advert_id'] }}" t_val="{{ $advert['title'] }}" onclick="application(this)">立即申请</a>
        </div>
    </div>
</div>
@endforeach
@endif
<!-- m-ed end -->
@if(!empty($loans))
<!-- diviler start -->
<div class="diviler"></div>
<!-- diviler end -->
<!-- dk-list start -->
<div class="dk-list">
    <div class="title" onclick="loanClick()">热门推荐贷款<i class="icn icn-left"></i></div>
    <ul class="prod-list">
        @foreach($loans as $loan)
        <li>
            <a href="{{ URL('detail').'/'.$loan['product_id'] }}">
                <div class="l">
                    <h3 class="price">{{ $loan['limit'] }}</h3>
                    <p class="dec small">额度范围(元)</p>
                </div>
                <div class="r">
                    <p class="t">推荐理由：{{ $loan['reasons'] }}</p>
                    <p class="dec small">{{ $loan['title'] }}</p>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
<!-- dk-list end -->
@endif
@if(!empty($cards))
<!-- diviler start -->
<div class="diviler"></div>
<!-- diviler end -->
<!-- xyk-list start -->
<div class="xyk-list">
    <div class="title" onclick="cardClick()">热门信用卡推荐<i class="icn icn-left"></i></div>
    <ul class="prod-list xyk">
        @foreach($cards as $card)
        <li>
            <a href="{{ URL('detail').'/'.$card['product_id'] }}">
                <div class="l avatar" style="background-image:url({{ env('IMAGE_URL').$card['img'] }})">
                </div>
                <div class="r">
                    <p class="t">推荐理由：{{ $card['reasons'] }}</p>
                    <p class="dec small" style="width:100%;margin-left:-10%;">{{ $card['title'] }}</p>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endif
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
var type = 1;
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
function loanClick(){
    location.href='{{ URL('list')}}/2';
}
function cardClick(){
    location.href='{{ URL('list')}}/4';
}
</script>
@endsection