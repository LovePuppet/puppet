@extends('admin.parent')
@section('title','新增礼品')
@section('head_js')
@endsection
@section('head_css')
@endsection
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <h1>
        新增礼品
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL('admin')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li><a href="{{URL('admin/gift/list')}}">礼品列表</a></li>
        <li class="active">新增礼品</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!--
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>
                </div>
                -->
                <!-- /.box-header -->
                <!-- form start -->
                @if(Session::has('error_msg'))
                <div class="callout callout-danger" id="login-box-msg" style="display:block;">
                    <h4 id="show_error_msg">{{ session('error_msg') }}</h4>
                </div>
                @else
                <div class="callout callout-danger" id="login-box-msg" style="display:none;">
                    <h4 id="show_error_msg"></h4>
                </div>
                @endif
                <form role="form" action="{{URL('admin/gift/create/save')}}" method="post" id="data_form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">名称<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="请输入名称" required>
                        </div>
                        <div class="form-group">
                            <label for="explain">说明</label>
                            <input type="text" class="form-control" id="explain" name="explain" placeholder="请输入说明">
                        </div>
                        <div class="form-group">
                            <label for="img_file">列表图片<span style="color: red">*</span></label>
                            <input type="file" class="btn-info left" id="img_file" name="img_file" accept="image/jpeg,image/png,image/gif">
                            <input type="button" class="btn btn-info btn-sm pull-right" style="margin:-30px 60px;" onclick="uploadImg('img_file','img','show_img_url');" value="上传" />
                            <br>
                            <span class="help-block left">建议上传130*155</span>
                        </div>
                        <div class="form-group">
                            <label for="img">列表图片<span style="color: red">*</span></label>
                            <input type="hidden" class="form-control" id="img" name="img">
                            <span class="mailbox-attachment-icon has-img">
                                <img src="" id="show_img_url"/>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="detail_img_file">详情图片<span style="color: red">*</span></label>
                            <input type="file" class="btn-info left" id="detail_img_file" name="detail_img_file" accept="image/jpeg,image/png,image/gif">
                            <input type="button" class="btn btn-info btn-sm pull-right" style="margin:-30px 60px;" onclick="uploadImg('detail_img_file','detail_img','show_detail_img_url');" value="上传" />
                            <br>
                            <span class="help-block left">建议上传130*155</span>
                        </div>
                        <div class="form-group">
                            <label for="detail_img">详情图片<span style="color: red">*</span></label>
                            <input type="hidden" class="form-control" id="detail_img" name="detail_img">
                            <span class="mailbox-attachment-icon has-img">
                                <img src="" id="show_detail_img_url"/>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="sort">排序</label>
                            <input type="text" class="form-control" id="sort" name="sort">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">提 交</button>
                        <button type="button" class="btn btn-danger pull-right" onclick="history.go(-1)">取 消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
@section('foot_js')
<script src="{{ asset('/js/tools.js') }}"></script>
<script type="text/javascript">
var image_domain = '{{ env('IMAGE_URL') }}';
$(document).ready(function(){
    $('#data_form').submit(function(){
        var title  =  $.trim($("#title").val());
        var img  =  $.trim($("#img").val());
        var detail_img = $.trim($("#detail_img").val());
        if(title == ''){
            $('#show_error_msg').html('请输入名称');
            $("#login-box-msg").show();
            return false;
        }
        if(img == ''){
            $('#show_error_msg').html('请上传列表图片');
            $("#login-box-msg").show();
            return false;
        }
        if(detail_img == ''){
            $('#show_error_msg').html('请上传详情图片');
            $("#login-box-msg").show();
            return false;
        }
    })
})
function uploadImg(file_id,file_val,show_file){
    var xhr = new XMLHttpRequest();
    //定义表单变量
    var file = document.getElementById(file_id).files;
    if(file.length > 1){
        puppet.mesWarn('只能上传1张图片');
        return false;
    }
    if(file.length <= 0){
        puppet.mesWarn('请选择图片文件');
        return false;
    }
    //新建一个FormData对象
    var formData = new FormData();
    //追加文件数据
    for(i=0;i<file.length;i++){
        formData.append("file["+i+"]", file[i]);
    }
    //post方式
    xhr.open('POST', '{{ URL('image/upload')}}'); //第二步骤
    //发送请求
    xhr.send(formData);  //第三步骤
    //ajax返回
    xhr.onreadystatechange = function(event){ //第四步
        if (xhr.readyState == 4 && xhr.status == 200) {
            var result = event.target.responseText;
            var json = JSON.parse(result);
            if(json.error == true){
                puppet.mesWarn(json.message);
            }else{
                $('#'+file_val).val(json.data);
                $('#'+show_file).attr('src',image_domain+json.data);
            }
        }
    };
}
</script>
@endsection