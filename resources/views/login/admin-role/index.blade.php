@extends('admin.parent')
@section('title','管理员角色列表')
@section('head_js')
@endsection
@section('head_css')
<link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
              管理员角色列表
              <small></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
              <li class="active">管理员角色列表</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ URL('admin/role/create') }}" class="btn btn-success">新增管理员角色</a>
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="admin_role_list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>角色名</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>编号</th>
                                    <th>角色名</th>
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
var admin_role_list_ajax;
$(function () {
    admin_role_list_ajax = $("#admin_role_list").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "ajax":'{{ URL('admin/role/list/ajax') }}',
        "columns":[
            {"data":"admin_role_id"},
            {"data":"role_name"},
            {"data":"status"},
            {"data":null,render:function(data,type,row){
                return  "<a href='{{ URL('admin/role/view') }}/"+data.admin_role_id+"' title='查看' aria-label='View' data-pjax='0'><span class='glyphicon glyphicon-eye-open'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;"+
                        "<a href='{{ URL('admin/role/edit') }}/"+data.admin_role_id+"' title='修改' aria-label='Update' data-pjax='0'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;"+
                        "<a href='javascript:void(0);' title='删除' aria-label='Delete' data-pjax='0' onclick='actionAdmin("+data.admin_role_id+",-1)'><span class='glyphicon glyphicon-trash'></span></a>";
            }},
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
            switch(data.status){
                case 1:
                    var button_htm = "<a href='javascript:void(0);' class='btn btn-danger btn-xs' onclick='actionAdmin("+data.admin_role_id+",0)'>关闭</a>";
                    $('td:eq(2)',row).html('开启 &nbsp;&nbsp;'+button_htm);
                    break;
                case 0:
                    var button_htm = "<a href='javascript:void(0);' class='btn btn-success btn-xs' onclick='actionAdmin("+data.admin_role_id+",1)'>开启</a>";
                    $('td:eq(2)',row).html( '关闭 &nbsp;&nbsp;'+button_htm);
                    break;
                default:
                    $('td:eq(2)',row).html( '已删除' );
                    break;
            }
	},
        "fnServerParams":function(data){
            data.push({"name":"action","value":"my_vlaue"});
        }
    });
});
function actionAdmin(id,status){
    var result;
    switch(status){
        case 0:
            result = confirm("是否确认关闭该角色，关闭后，该角色权限将不能显示");
            break;
        case 1:
            result = confirm("是否确认启用该角色");
            break;
        case -1:
            result = confirm("是否确认删除该角色");
            break;
        default:
            result = confirm("是否确认删除该角色");
            break;   
    }
    if(result){
        var url = "{{URL('admin/role/delete')}}";
        var data = {id:id,status:status};
        var is_success = puppet.myajax('post',url,data,false);
        if(is_success.code == true){
            alert(is_success.message);
            return false;
        }else{
            admin_role_list_ajax.ajax.reload();
        }
    }
    return false;
}
</script>
@endsection