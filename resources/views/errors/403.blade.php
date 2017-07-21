@extends('admin.parent')
@section('title','403 error')
@section('head_js')
@endsection
@section('head_css')
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        403 无权限
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">403 error</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 403</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i>无权限查看</h3>
          <p>
            联系超级管理员
            或者返回<a href="{{URL('admin')}}">首页</a>
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('foot_js')
@endsection