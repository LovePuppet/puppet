<?php
namespace App\Components;

/**
 * 图片上传类
 * @author 郭钊林
 */
class ImageTools{
    public $document_root = '';//根路径
    public $img = '';//banner路径
    public $img_size = 2097152; //2M
    public $max_img_size = 4194304; //4M
    public $img_type_arr = ['image/gif','image/pjpeg','image/jpeg','image/png', 'image/x-png','image/bmp'];
    public $ext_arr = ['image/gif' => '.gif', 'image/pjpeg' => '.jpg', 'image/jpeg' => '.jpg', 'image/png' => '.png', 'image/x-png' => '.png'];
    
    public function __construct() {
        $this->document_root = $_SERVER['DOCUMENT_ROOT'];
        $this->img = $this->document_root.env('IMAGE_URL','/upload/image');
    }
    
    public function index(){
        $result = ['error' => false,'message' => '','data' => []];
        $path = $this->img.'/'.date('Ym').'/'.date('d').'/';
        $this->createFolder($path);
        if(isset($_FILES)){
            $file_error = false;
            foreach ($_FILES['file']['error'] as $error){
                $error != 0 && $file_error = true;
            }
            if($file_error){
                $result['error'] = true;
                $result['message'] = '上传失败';
            }else{
                $file_size = false;
                foreach ($_FILES['file']['size'] as $size){
                    $size > $this->img_size && $file_size = true;
                }
                if($file_size){
                    $result['error'] = true;
                    $result['message'] = '图片大小不能大于2M';
                }else{
                    $file_type = false;
                    foreach ($_FILES['file']['type'] as $type){
                        !in_array($type, $this->img_type_arr) && $file_type = true;
                    }
                    if($file_type){
                        $result['error'] = true;
                        $result['message'] = '不支持的图片格式';
                    }else{
                        $data = [];
                        $file_tmp_name = false;
                        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name){
                            $file_name = $this->ext_arr[$_FILES['file']['type'][$key]];
                            $file_name = md5($tmp_name).$file_name;
                            $file_path = $path . '/' . $file_name;
//                            $file_paths['size'] = $_FILES['file']['size'][$key];
                            if(!move_uploaded_file($tmp_name, $file_path)){
                                $file_tmp_name = true;
                            }
                            $data[] = '/'.date('Ym').'/'.date('d').'/'.$file_name;
                        }
                        if($file_tmp_name){
                            $result['error'] = true;
                            $result['message'] = '图片上传失败';
                            $result['data'] = [];
                        }else{
                            $result['data'] = $data;
                        }
                    }
                }
            }
        }else{
            $result['error'] = true;
            $result['message'] = '请选择图片';
        }
        return $result;
    }
    
    public function deleteImg($snapshot){
        $result = ['error' => false,'message' => '','data' => []];
        $file_path = $this->img.$snapshot;
        if(file_exists($file_path)){
            unlink($file_path);
        }else{
            $result['error'] = true;
            $result['message'] = '文件不存在';
        }
        return $result;
    }
    
    public function iosAppIcon(){
        $result = ['error' => false,'message' => '','data' => ''];
        $path = $this->img.'/'.date('Ym').'/'.date('d').'/';
        $this->createFolder($path);
        if(isset($_FILES)){
            if($_FILES['file']['error'][0]){
                $result['error'] = true;
                $result['message'] = '上传失败';
            }else{
                if($_FILES['file']['size'][0] > $this->img_size){
                    $result['error'] = true;
                    $result['message'] = '图片大小不能大于2M';
                }else{
                    if(!in_array($_FILES['file']['type'][0], $this->img_type_arr)){
                        $result['error'] = true;
                        $result['message'] = '不支持的图片格式';
                    }else{
                        $file_name = $this->ext_arr[$_FILES['file']['type'][0]];
                        $file_name = md5($_FILES['file']['tmp_name'][0]).$file_name;
                        $file_path = $path . '/' . $file_name;
                        if(!move_uploaded_file($_FILES['file']['tmp_name'][0], $file_path)){
                            $result['error'] = true;
                            $result['message'] = '图片上传失败';
                        }else{
                            $result['data'] = '/'.date('Ym').'/'.date('d').'/'.$file_name;
                        }
                    }
                }
            }
        }else{
            $result['error'] = true;
            $result['message'] = '请选择图片';
        }
        return $result;
    }
    
    public function banner(){
        $result = ['error' => false,'message' => '','data' => ''];
        $path = $this->banner.'/'.date('Ym').'/'.date('d').'/';
        $this->createFolder($path);
        if(isset($_FILES)){
            if($_FILES['file']['error'][0]){
                $result['error'] = true;
                $result['message'] = '上传失败';
            }else{
                if($_FILES['file']['size'][0] > $this->img_size){
                    $result['error'] = true;
                    $result['message'] = '图片大小不能大于2M';
                }else{
                    if(!in_array($_FILES['file']['type'][0], $this->img_type_arr)){
                        $result['error'] = true;
                        $result['message'] = '不支持的图片格式';
                    }else{
                        $file_name = $this->ext_arr[$_FILES['file']['type'][0]];
                        $file_name = md5($_FILES['file']['tmp_name'][0]).$file_name;
                        $file_path = $path . '/' . $file_name;
                        if(!move_uploaded_file($_FILES['file']['tmp_name'][0], $file_path)){
                            $result['error'] = true;
                            $result['message'] = '图片上传失败';
                        }else{
                            $result['data'] = '/'.date('Ym').'/'.date('d').'/'.$file_name;
                        }
                    }
                }
            }
        }else{
            $result['error'] = true;
            $result['message'] = '请选择图片';
        }
        return $result;
    }
    
    /**
     * $avatarUrl图片地址
     * 图片二进制流
     */
    public function wxWriteImage($avatarUrl){
//        $data = file_get_contents($avatarUrl);
        $ch=curl_init(); 
        $timeout=5; 
        curl_setopt($ch,CURLOPT_URL,$avatarUrl); 
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); 
        $data=curl_exec($ch);
        curl_close($ch);
        
        $path = $this->img.'/'.date('Ym').'/'.date('d').'/';
        $file_name = '';
        //数据流不为空，则进行保存操作
        if(!empty($data)){
            $file_name = md5($data) . '.jpg';
            $this->createFolder($path);
            //创建并写入数据流，然后保存文件
            $file = fopen($path . $file_name, "w"); //打开文件准备写入 
            fwrite($file, $data); //写入
            fclose($file);
        }
        return '/'.date('Ym').'/'.date('d').'/'.$file_name;
    }
    
    private function createFolder($path) {
        if (!file_exists($path)) {
            $this->createFolder(dirname($path));
            mkdir($path);
            chmod($path, 0777);
        }
    }
}
