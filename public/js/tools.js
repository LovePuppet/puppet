/**
 * puppet
 * 郭钊林
 * 2017.03.31
 */
var puppet = {
    mail_filter:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
    pwd_filter:/([a-zA-Z0-9]{2,4})/,
    mobile_filter:/^1\d{10}$/,
    //ajax提交
    myajax:function(method = 'post',url = '',data = '',async = true,dataType = 'json'){
        var result;
        $.ajax({
            type:method,
            url:url,
            data:data,
            dataType:dataType,
            async:async,
            success:function(data){
                result = data;
            }
        });
        return result;
    },
    //验证邮箱
    checkMail:function(mail) {
        if (this.mail_filter.test(mail))
            return true;
        else
            return false;
    },
    //验证特殊字符
    checkusrandpwd(inp) {
        if(this.pwd_filter.test(inp))
            return true;
        else
            return false;
    },
    //验证手机号码
    checkMobile(mobile) {
        if(this.mobile_filter.test(mobile))
            return true;
        else
            return false;
    },
    //时间戳转时间格式为 2017-04-10 14:09:20
    dataFormat(timestamp){
        var time = new Date(timestamp*1000);
        var year = time.getFullYear();
        var month = time.getMonth()+1;
        var date = time.getDate();
        var hours = time.getHours();
        var minutes = time.getMinutes();
        var seconds = time.getSeconds();
        return year+'-'+month+'-'+date+' '+hours+':'+minutes+':'+seconds;
    },
    //消息提示框
    showMessage(tip, type){
        var $tip = $('#tip');
        if ($tip.length == 0) {
            $tip = $('<span id="tip" style="font-weight:bold;position:fixed;top:35%;left: 50%;z-index:9999;"></span>');
            $('body').append($tip);
        }
        $tip.stop(true).attr('class', 'alert alert-' + type).text(tip).css('margin-left', -$tip.outerWidth() / 2).fadeIn(500).delay(3000).fadeOut(500);
    },
    mesInfo(msg){
        this.showMessage(msg,'info');
    },
    mesSuccess(msg){
        this.showMessage(msg,'success');
    },
    mesFailure(msg){
        this.showMessage(msg,'danger');
    },
    mesWarn(msg){
        this.showMessage(msg,'warning');
    },
    appstoreApkUpload(result){
        var json = eval('('+result+')');
        $('#file_size').val(json.data.size);
        $('#apk_url').val(json.data.name);
        $('#icon_url').val(json.data.icon_url);
        $('#package_name').val(json.data.package_name);
        $('#version').val(json.data.version);
        $('#version_code').val(json.data.version_code);
        $('#show_icon_img').attr('src',json.data.show_icon);
    },
    formatDateTime(inputTime) {
        var date = new Date(inputTime);  
        var y = date.getFullYear();    
        var m = date.getMonth() + 1;    
        m = m < 10 ? ('0' + m) : m;    
        var d = date.getDate();    
        d = d < 10 ? ('0' + d) : d;    
        var h = date.getHours();  
        h = h < 10 ? ('0' + h) : h;  
        var minute = date.getMinutes();  
        var second = date.getSeconds();  
        minute = minute < 10 ? ('0' + minute) : minute;    
        second = second < 10 ? ('0' + second) : second;   
        return y + '-' + m + '-' + d+' '+h+':'+minute+':'+second;    
    },
}



