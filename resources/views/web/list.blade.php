@extends('web.parent')
@section('title','长城宽带金融--列表')
@section('head_css')
@endsection
@section('content')
<div id="app">
<div class="header"><a class="back" href="javascript:void(0);" onclick="history.go(-1)">返回</a>列表</div>
<!-- diviler start -->
@if(!empty($categories))
<div class="diviler"></div>
<!-- diviler end -->
<ul class="lc-tabs">
    @foreach($categories as $category)
    <li>
        <a href="javascript:void(0)">
            <span class="dec">{{ $category['category_name'] }}</span>
            <div class="avatar" style="background-image:url({{ env('IMAGE_URL').$category['icon_url'] }})"></div>
        </a>
    </li>
    @endforeach
</ul>
@endif
<div class="diviler"></div>
<!-- diviler end -->
<ul class="lc-tabs">
    <li>
        <a href="javascript:void(0)">
            <span class="dec">基金理财</span>
            <div class="avatar" style="background-image:url(/web/images/lc-1.png)"></div>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)">
            <span class="dec">银行理财</span>
            <div class="avatar" style="background-image:url(/web/images/lc-2.png)"></div>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)">
            <span class="dec">证券</span>
            <div class="avatar" style="background-image:url(/web/images/lc-3.png)"></div>
        </a>
    </li>
    <li>
        <a href="javascript:void(0)">
            <span class="dec">其他</span>
            <div class="avatar" style="background-image:url(/web/images/lc-4.png)"></div>
        </a>
    </li>
</ul>
<!-- diviler start -->
<div class="diviler"></div>
<!-- diviler end -->
<!-- xyk-list start -->
<div class="xyk-list">
    <div class="title">{{ $data['category_name'] }}</div>
    @if(!empty($products))
    <ul class="prod-list licai">
        @foreach($products as $key => $product)
        <li>
            <a href="{{ URL('detail').'/'.$product['product_id'] }}">
                <div class="l avatar" style="background-image:url({{ env('IMAGE_URL').$product['img'] }})">
                </div>
                <div class="r">
                    <p class="t">{{ $product['title'] }}</p>
                    <p class="info small">{{ $product['explain'] }}</p>
                    <p class="dec small"><span class="red">{{ $product['applicants'] }}人</span><span>本月申请</span></p>
                    <i class="icn lc-icn @if($key == 0) icn-one @elseif($key == 1) icn-two @elseif($key ==2) icn-three @endif"></i>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@include('web.footer')
</div>
@endsection
@section('foot_js')
@endsection

