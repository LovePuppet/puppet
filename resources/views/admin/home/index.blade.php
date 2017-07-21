@extends('admin.parent')
@section('title','Puppet后台管理系统')
@section('head_js')
@endsection
@section('head_css')
<style>
    .users-list img{
        min-width:80px;
        min-height:80px;
        max-width:80px;
        max-height:80px;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Puppet后台管理系统</h1>
        <ol class="breadcrumb">
          <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i>admin</a></li>
        </ol>
    </section>
    <section class="content">
        <h1>欢迎登录Puppet后台管理系统</h1>
    </section>
</div>
@endsection
@section('foot_js')
@endsection