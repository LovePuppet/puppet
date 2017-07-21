<?php

namespace App\Components;
use Cache;
use Carbon\Carbon;

/**
 * 工具类
 *
 * @author 郭钊林
 */
class Tools {
    private static $allow_url = [
        '/admin',
        '/admin/update/password',
    ];

    /**
     * api接口返回格式
     */
    public static function getApiReturnData($data, $message, $error = FALSE) {
        return json_encode(['error' => $error, 'message' => $message, 'data' => $data]);
    }
    
    /**
     * 生成验证码6位随机数
     */
    public static function getVerCode() {
        return rand(100000, 999999);
    }
    
    /**
     * 将对象或者数组里包含的对象全部转成数组
     * @param $array  array or obj
     * @return array
     */
    public static function objectToArray($array) {
        if(is_object($array)) {
            $array = (array)$array;
        }
        if(is_array($array)) {
            foreach($array as $key => $value) {
                $array[$key] = self::objectToArray($value);
            }
        }
        return $array;
    }
    
    /**
     * 验证手机号码的格式是否正确
     */
    public static function verifyMobile($mobile){
        return preg_match("/^1[34578]\d{9}$/",$mobile);
    }
    
    /**
     * 根据生日，算年龄
     */
    public static function getAge($birthday){
        $age = strtotime($birthday);
        if($age === false){
            return false;
        }
        list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age));
        $now = strtotime("now");
        list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now));
        $age = $y2 - $y1;
        if((int)($m2.$d2) < (int)($m1.$d1))
        $age -= 1;
        return $age;
    }
    
    /**
     * 拼接上图片域名
     * @param string $image_url
     */
    public static function addImageHost($image_url){
        $res = false;
        if(!empty($image_url)){
            if(strstr($image_url,"http")){
                $res = $image_url;
            }else{
                $url = env('FILE_DOMAIN','http://file.xzb.com').env('IMAGE_URL','/image');
                $res = $url.$image_url;
            }
        }
        return $res;
    }
    
    /**
     * 后台管理员登录密码加密
     * $password  密码
     * $v_password 需要验证的密码
     */
    public static function passwordEncryption($password,$v_password = ''){
        $result = true;
        if(empty($v_password)){
            $result = md5(env('ADMIN_PASSWORD','cckdjr2017').md5($password));
        }else{
            (self::passwordEncryption($v_password) != $password) && $result = false;
        }
        return $result;
    }
    
    /**
     * 所有权限数据
     */
    public static function adminLimits($refresh = false){
        $result = '';
        if(Cache::has('adminLimits')){
            if($refresh){
                Cache::forget('adminLimits');
                self::adminLimits();
            }
            $result = Cache::get('adminLimits');
        }else{
            $oAdminLimit = new \App\Models\AdminLimit;
            $result = $oAdminLimit->getAllData();
            $expiresAt = Carbon::now()->addDays(7);//缓存7天
            Cache::put('adminLimits',$result,$expiresAt);
        }
        return $result;
    }
    
    /**
     * 所有角色数据
     */
    public static function adminRoles($refresh = false){
        $result = '';
        if(Cache::has('adminRoles')){
            if($refresh){
                Cache::forget('adminRoles');
                self::adminLimits();
            }
            $result = Cache::get('adminRoles');
        }else{
            $oAdminRole = new \App\Models\AdminRole;
            $result = $oAdminRole->getAllData();
            $expiresAt = Carbon::now()->addDays(7);//缓存7天
            Cache::put('adminRoles',$result,$expiresAt);
        }
        return $result;
    }
    
    /**
     * 根据权限limit_ids
     * 获取权限名称数组，或者权限url数组
     */
    public static function getAdminLimitsNameOrUrl($limit_ids,$val = 'limit_name'){
        $adminLimits = self::adminLimits();
        $result = [];
        foreach ($adminLimits as $limit){
            if(in_array($limit['admin_limit_id'], $limit_ids)){
                $result[] = $limit[$val];
            }
        }
        return $result;
    }
    
    /**
     * 验证一个url是否有权限访问
     */
    public static function urlLimit($url,$request){
        $result = false;
        if(!empty($url)){
            $url = preg_replace('/\?(\S+)/', '', $url);//正则替换掉url参数 ?id=...&name=...
            $url = preg_replace('/\/\d{0,}$/','',$url);//正则替换掉/1
            $userLimits = [];
            if($request->session()->has('userLimits')){
                $session_limits = $request->session()->get('userLimits');
                $userLimits = !empty($session_limits) ? $session_limits[0] : [];
            }
            if(in_array($url, self::$allow_url) || in_array($url,$userLimits)){
                $result = true;
            }
        }
        return $result;
    }
    
    /**
     * 获取随机字符串
     * @param type $length 字符串长度
     * @return string 字符串
     */
    public static function getRandChar($length){
        $str = null;
        $strPol = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $max = strlen($strPol)-1;
        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }
    
    /**
     * 大咖/干货是否显示更新状态
     */
    public static function getUpdateStatus($time){
        $show_time = strtotime("-1 day");
        return ($time >= $show_time) ? 1 : 0;
    }
    
    /**
     * 动态发布时间显示
     */
    public static function showDateTime($create_time){
        $name = '';
        if(date('Y') == date('Y',$create_time)){
            $time = time() - $create_time;
            if($time <= 60){
                $name = '刚刚';
            }elseif($time > 60 && $time <= 3600){
                $name = intval($time/60).'分钟前';
            }elseif($time > 3600 && $time <= 24*60*60){
                $name = intval($time/3600).'小时前';
            }else{
                $name = date('m-d',$create_time);
            }
        }else{
            $name = date('Y-m-d',$create_time);
        }
        return $name;
    }
    
    /**
     * 微信用户token生成
     */
    public static function createUserToken($openid){
        return md5(md5($openid).'Puppet2017');
    }
    
    /**
     * 显示时间
     * $duration秒
     * 将秒转成  时：分：秒
     */
    public static function showTime($duration){
        $result = '';
        $hour = '';
        $minute = intval($duration/60);
        $second = $duration%60;
        if($minute > 60){
            $hour = intval($minute/60);
            $hour = (strlen($hour) < 2) ? '0'.$hour : $hour;
            $minute = $minute%60;
            $minute = (strlen($minute) < 2) ? '0'.$minute : $minute;
            $second = $duration - intval($hour*3600) - intval($minute*60);
            $second = (strlen($second) < 2) ? '0'.$second : $second;
        }elseif($duration < 60){
            $minute = '00';
            $second = $duration;
            $second = (strlen($second) < 2) ? '0'.$second : $second;
        }else{
            $minute = (strlen($minute) < 2) ? ('0'.$minute) : $minute;
            $second = (strlen($second) < 2) ? '0'.$second : $second;
        }
        return !empty($hour) ? ($hour.':'.$minute.':'.$second) : ($minute.':'.$second);
    }
    
    /**
     * 将时：分：秒
     * 转成秒
     */
    public static function turnIntoSeconds($time){
        $result = $time;
        if(strpos($time,':') !== false){
            $time_arr = explode(':',$time);
            if(count($time_arr) == 2){
                $result = $time_arr[0]*60 + $time_arr[1];
            }elseif(count($time_arr) == 3){
                $result = $time_arr[0]*3600 + $time_arr[1]*60 + $time_arr[2];
            }
        }
        return $result;
    }
    
    /**
     * 订单号生成方法
     * @param int $user_id 用户编号
     */
    public static function getOrderNumber($user_id = 0) {
        return date('YmdHis').$user_id.rand(1000, 9999);
    }
    
    /**
     * 获取微信订单签名
     * @param array $arr 订单数组
     * $key_ Api key
     */
    public static function getWechatSign($arr,$key_){
        ksort($arr);
        $string = '';
        foreach( $arr as $key => $val ){
            $string .= $key . '=' . $val.'&';
        }
        $string .= 'key='.$key_;
        return strtoupper(md5($string));
    }
    
    /**
     * 时间戳转换星期几
     */
    public static function timeToWeek($time){
        $week = ['日','一','二','三','四','五','六'];
        return '星期'.$week[date('w',$time)];
    }
}