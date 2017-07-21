@extends('admin.parent')
@section('title','分类列表')
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
              分类列表
              <small></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
              <li class="active">分类列表</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ URL('admin/category/create') }}" class="btn btn-success">新增分类</a>
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="data_list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>上级分类名称</th>
                                    <th>图标</th>
                                    <th>名称</th>
                                    <th>说明</th>
                                    <th>排序</th>
                                    <th>上传时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>编号</th>
                                    <th>上级分类名称</th>
                                    <th>图标</th>
                                    <th>名称</th>
                                    <th>说明</th>
                                    <th>排序</th>
                                    <th>上传时间</th>
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
var list_ajax;
var image_domain = '{{ env('IMAGE_URL') }}';
$(function () {
    list_ajax = $("#data_list").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "ajax":'{{ URL('admin/category/list/ajax') }}',
        "columns":[
            {"data":"category_id"},
            {"data":"fid_name"},
            {"data":"icon_url"},
            {"data":"category_name"},
            {"data":"explain"},
            {"data":"sort"},
            {"data":"create_time"},
            {"data":"status"},
            {"data":null,render:function(data,type,row){
                return  "<a href='{{ URL('admin/category/view') }}/"+data.category_id+"' title='查看' aria-label='View' data-pjax='0'><span class='glyphicon glyphicon-eye-open'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;"+
                        "<a href='{{ URL('admin/category/edit') }}/"+data.category_id+"' title='修改' aria-label='Update' data-pjax='0'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;"+
                        "<a href='javascript:void(0);' title='删除' aria-label='Delete' data-pjax='0' onclick='actionData("+data.category_id+",-1)'><span class='glyphicon glyphicon-trash'></span></a>";
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
            $('td:eq(2)',row).html("<img src='"+image_domain+data.icon_url+"' class='icon_img_css' />");
            switch(data.status){
                case 1:
                    $('td:eq(7)',row).html('开启');
                    break;
                case 0:
                    $('td:eq(7)',row).html( '关闭');
                    break;
                default:
                    $('td:eq(7)',row).html( '已删除' );
                    break;
            }
            var time = new Date(data.create_time*1000);
            var create_time = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate()+' '+time.getHours()+':'+time.getMinutes()+':'+time.getSeconds();
            $('td:eq(6)',row).html(create_time);
	},
        "fnServerParams":function(data){
            data.push({"name":"action","value":"my_vlaue"});
        }
    });
});
function actionData(id,status){
    var result;
    switch(status){
        case 0:
            result = confirm("是否确认关闭该分类");
            break;
        case 1:
            result = confirm("是否确认启用该分类");
            break;
        case -1:
            result = confirm("是否确认删除该分类");
            break;
        default:
            result = confirm("是否确认删除该管理员");
            break;   
    }
    if(result){
        var url = "{{URL('admin/category/delete')}}";
        var data = {id:id,status:status};
        var is_success = puppet.myajax('post',url,data,false);
        if(is_success.code == true){
            alert(is_success.message);
            return false;
        }else{
            list_ajax.ajax.reload(null,false);
        }
    }
    return false;
}
</script>
@endsection