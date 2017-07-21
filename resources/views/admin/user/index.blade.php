@extends('admin.parent')
@section('title','用户列表')
@section('head_js')
@endsection
@section('head_css')
<link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap.css') }}">
<style type="text/css">
    .icon_img_css{
        max-width:60px;
        max-height:60px;
    }
</style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
              用户列表
              <small></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
              <li class="active">用户列表</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="user_list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>唯一标识</th>
                                    <th>姓名</th>
                                    <th>手机号</th>
                                    <th>头像</th>
                                    <th>地址</th>
                                    <th>注册时间</th>
                                    <th>最后登录时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>编号</th>
                                    <th>唯一标识</th>
                                    <th>姓名</th>
                                    <th>手机号</th>
                                    <th>头像</th>
                                    <th>地址</th>
                                    <th>注册时间</th>
                                    <th>最后登录时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
@endsection
@section('foot_js')
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/js/fastclick.js') }}"></script>
<script src="{{ asset('/js/tools.js') }}"></script>
<script>
var user_list_ajax;
var image_domain = '{{ env('IMAGE_URL') }}';
$(function () {
    user_list_ajax = $("#user_list").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "ajax":'{{ URL('admin/user/list/ajax') }}',
        "columns":[
            {"data":"user_id"},
            {"data":"token"},
            {"data":"name"},
            {"data":"mobile"},
            {"data":"head_img"},
            {"data":"address"},
            {"data":"create_time"},
            {"data":"last_login_time"},
            {"data":"status"},
            {"data":null,render:function(data,type,row){
                return  "<a href='{{ URL('admin/user/view') }}/"+data.user_id+"' title='查看' aria-label='View' data-pjax='0'><span class='glyphicon glyphicon-eye-open'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }},
        ],
        "aaSorting":[
            [0,'desc']
        ],
        "oLanguage": {
            "sLengthMenu": "_MENU_ 条/页",
            "oPaginate": {
                "sPrevious": "上一页",
                "sNext": "下一页"
            },
            "sZeroRecords":"没有匹配结果",
            "sInfo":"显示第 _START_ 至 _END_ 条数据，共 _TOTAL_ 条数据",
            "sInfoEmpty":"显示 第 0 至 0 项 结果，共 0 项",
            "sInfoFiltered":"(由 _MAX_ 项结果过滤)",
            "sSearch":"搜索",
            "sEmptyTable":"无数据",
            "sProcessing":"加载中..."
        },
        "aLengthMenu":[10,20,50],
        "fnCreatedRow": function( row, data, dataIndex ) {
            $('td:eq(4)',row).html("<img src='/images/head.jpg' class='icon_img_css' />");
            switch(data.status){
                case 1:
                    $('td:eq(8)',row).html('开启');
                    break;
                case 0:
                    $('td:eq(8)',row).html( '关闭');
                    break;
                default:
                    $('td:eq(8)',row).html( '已删除' );
                    break;
            }
            var time_ = new Date(data.create_time*1000);
            var create_time = time_.getFullYear()+'-'+(time_.getMonth()+1)+'-'+time_.getDate()+' '+time_.getHours()+':'+time_.getMinutes()+':'+time_.getSeconds();
            $('td:eq(6)',row).html(create_time);
            var time = new Date(data.last_login_time*1000);
            var last_login_time = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate()+' '+time.getHours()+':'+time.getMinutes()+':'+time.getSeconds();
            $('td:eq(7)',row).html(last_login_time);
	},
        "fnServerParams":function(data){
            data.push({"name":"action","value":"my_vlaue"});
        }
    });
});
</script>
@endsection