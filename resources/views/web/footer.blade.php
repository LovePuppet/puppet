<!-- lp-list end -->
<div class="bar-fix"></div>
<!-- bar start -->
<div class="bar">
    <ul class="list">
        <li>
            <a href="{{ URL('home') }}">
                <i class="icn icn-menu-home @if(isset($foot) && $foot == 'home') active @endif"></i>
                <p class="small">首页</p>
            </a>
        </li>
        <li>
            <a href="{{ URL('gift') }}">
                <i class="icn icn-menu-gift  @if(isset($foot) && $foot == 'gift') active @endif"></i>
                <p class="small">礼品</p>
            </a>
        </li>
        <li>
            <a href="{{ URL('my') }}">
                <i class="icn icn-menu-my @if(isset($foot) && $foot == 'my') active @endif"></i>
                <p class="small">我的</p>
            </a>
        </li>
    </ul>
</div>
<!-- bar end -->