@extends('web.parent')
@section('title','长城宽带金融--礼品')
@section('head_css')
@endsection
@section('content')
<div id="app">
<div class="header"><a class="back" href="javascript:void(0);" onclick="history.go(-1)">返回</a>礼品</div>
@if(!empty($data))
@foreach($data as $val)
<div class="lp-banner" style="background-image:url({{ env('IMAGE_URL').$val['img'] }})"></div>
@endforeach
@endif
@if(!empty($gifts))
<!-- lp-list start -->
<ul class="lp-list">
    @foreach($gifts as $gift)
    <li>
        <a href="{{ URL('gift/detail').'/'.$gift['gift_id'] }}">
            <div class="avatar" style="background-image:url({{ env('IMAGE_URL').$gift['img'] }})"></div>
            <div class="content">
                <p class="title">{{ $gift['title'] }}</p>
                <p class="dec">{{ $gift['explain'] }}</p>
                <div class="btn btn-full btn-radius" href="{{ URL('gift/detail').'/'.$gift['gift_id'] }}">立即申请</div>
            </div>
        </a>
    </li>
    @endforeach
</ul>
@endif
@include('web.footer')
</div>
@endsection
@section('foot_js')
@endsection
