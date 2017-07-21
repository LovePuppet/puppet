<?php
namespace App\Components;
/**
 * 文件上传工具类
 * @author 郭钊林
 */
class FileTools{
    public $video_path = '';
    public $document_root = '';//根路径
    public $video_max_size = 524288000;   //500M
    public function __construct() {
        $this->document_root = $_SERVER['DOCUMENT_ROOT'].'/../../'.'xzb-file';
        $this->video_path = $this->document_root.env('VIDEO_URL','/video');
    }
    
    public function index(){
        $path = $this->root_path.date('Ym').'/'.date('d').'/';
        $this->createFolder($path);
        if(isset($_FILES)){
            $file_error = false;
            foreach ($_FILES['file']['error'] as $error){
                $error != 0 && $file_error = true;
            }
            $file_size = false;
            foreach ($_FILES['file']['size'] as $size){
                $size > $this->img_size && $file_size = true;
            }
            $file_type = false;
            foreach ($_FILES['file']['type'] as $type){
                !in_array($type, $this->img_type_arr) && $file_type = true;
            }
            $file_paths = [];
            $file_tmp_name = false;
            foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name){
                $file_name = $this->ext_arr[$_FILES['file']['type'][$key]];
                $file_name = md5($tmp_name).$file_name;
                $file_path = $path . '/' . $file_name;
                $file_paths[] = $this->img_path.date('Ym').'/'.date('d').'/'.$file_name;
                if(!move_uploaded_file($tmp_name, $file_path)){
                    $file_tmp_name = true;
                }
            }
            if($file_error || $file_size || $file_type || $file_tmp_name){
                echo '上传失败';
            }else{
                echo implode(',', $file_paths);
            }
            exit;
        }
    }
    
    public function iosAppIcon(){
        $path = $this->icon_path;
        $this->createFolder($path);
        if(isset($_FILES)){
            $file_error = false;
            ($_FILES['file']['error'][0] != 0) && $file_error = true;
            
            $file_size = false;
            ($_FILES['file']['size'][0] > $this->img_size) && $file_size = true;
            
            $file_type = false;
            !in_array($_FILES['file']['type'][0], $this->img_type_arr) && $file_type = true;
            
            $file_tmp_name = false;
            $file_name = $this->ext_arr[$_FILES['file']['type'][0]];
            $file_name = md5($_FILES['file']['tmp_name'][0]).$file_name;
            $file_path = $path.$file_name;
            if(!move_uploaded_file($_FILES['file']['tmp_name'][0],$file_path)){
                $file_tmp_name = true;
            }
            if($file_error || $file_size || $file_type || $file_tmp_name){
                echo '上传失败';
            }else{
                echo $file_name;
            }
            exit;
        }
    }
    
    public function uploadVideo(){
        $result = ['error' => false,'message' => '','data' => ''];
        $path = $this->video_path.'/'.date('Ym').'/'.date('d').'/';
        $this->createFolder($path);
        if(isset($_FILES)){
            if($_FILES['file']['error'] != 0){
                $result['error'] = true;
                $result['message'] = '上传有误';
            }
            if($_FILES['file']['size'] > $this->video_max_size){
                $result['error'] = true;
                $result['message'] = '上传文件太大';
            }
            if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
                $name_arr = explode('.',$_FILES['file']['name']);
                $suffix = end($name_arr);
                if(strtolower($suffix) != 'mp3'){
                    $result['error'] = true;
                    $result['message'] = '文件格式错误';
                }else{
                    $file_name = md5($_FILES['file']['tmp_name']).'.'.$suffix;
                    $file_path = $path.$file_name;
                    if(!move_uploaded_file($_FILES['file']['tmp_name'],$file_path)){
                        $result['error'] = true;
                        $result['message'] = '上传失败';
                    }else{
                        $result['data'] = '/'.date('Ym').'/'.date('d').'/'.$file_name;
                    }
                }
            }
        }
        return $result;
    }
    
    private function createFolder($path) {
        if (!file_exists($path)) {
            $this->createFolder(dirname($path));
            mkdir($path, 0777);
        }
    }
}
