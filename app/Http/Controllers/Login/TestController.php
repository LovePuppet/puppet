<?php

namespace App\Http\Controllers\Login;
use App\Http\Controllers\Controller;

class TestController extends Controller{
    /**
     * 管理员列表页面
     * admin_tree_menu
     * 后台管理员管理select是否默认展开
     */
    public function index(){
        echo \App\Components\Tools::passwordEncryption('123456');
        exit;
    }
}
