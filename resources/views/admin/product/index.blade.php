@extends('admin.parent')
@section('title','商品列表')
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
              商品列表
              <small></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
              <li class="active">商品列表</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ URL('admin/product/create') }}" class="btn btn-success">新增商品</a>
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="data_list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>名称</th>
                                    <th>分类</th>
                                    <th>图标</th>
                                    <th>是否推荐</th>
                                    <th>推荐排序</th>
                                    <th>额度金额范围</th>
                                    <th>申请人数</th>
                                    <th>创建时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>编号</th>
                                    <th>名称</th>
                                    <th>分类</th>
                                    <th>图标</th>
                                    <th>是否推荐</th>
                                    <th>推荐排序</th>
                                    <th>额度金额范围</th>
                                    <th>申请人数</th>
                                    <th>创建时间</th>
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
        "ajax":'{{ URL('admin/product/list/ajax') }}',
        "columns":[
            {"data":"product_id"},
            {"data":"title"},
            {"data":"category_name"},
            {"data":"img"},
            {"data":"recommend"},
            {"data":"sort"},
            {"data":"limit"},
            {"data":"applicants"},
            {"data":"create_time"},
            {"data":"status"},
            {"data":null,render:function(data,type,row){
                return  "<a href='{{ URL('admin/product/view') }}/"+data.product_id+"' title='查看' aria-label='View' data-pjax='0'><span class='glyphicon glyphicon-eye-open'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;"+
                        "<a href='{{ URL('admin/product/edit') }}/"+data.product_id+"' title='修改' aria-label='Update' data-pjax='0'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;&nbsp;&nbsp;"+
                        "<a href='javascript:void(0);' title='删除' aria-label='Delete' data-pjax='0' onclick='actionData("+data.product_id+",-1)'><span class='glyphicon glyphicon-trash'></span></a>";
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
            $('td:eq(3)',row).html("<img src='"+image_domain+data.img+"' class='icon_img_css' />");
            var recommend = (data.recommend == 1) ? '是' : '否';
            $('td:eq(4)',row).html(recommend);
            switch(data.status){
                case 1:
                    $('td:eq(9)',row).html('开启');
                    break;
                case 0:
                    $('td:eq(9)',row).html( '关闭');
                    break;
                default:
                    $('td:eq(9)',row).html( '已删除' );
                    break;
            }
            var time = new Date(data.create_time*1000);
            var create_time = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate()+' '+time.getHours()+':'+time.getMinutes()+':'+time.getSeconds();
            $('td:eq(8)',row).html(create_time);
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
            result = confirm("是否确认关闭该商品");
            break;
        case 1:
            result = confirm("是否确认启用该商品");
            break;
        case -1:
            result = confirm("是否确认删除该商品");
            break;
        default:
            result = confirm("是否确认删除该管理员");
            break;   
    }
    if(result){
        var url = "{{URL('admin/product/delete')}}";
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