<?php

namespace app\admin\controller;

use think\Loader;
use think\Controller;
use think\facade\Request;
class Commth extends Controller
{
    //配置白名单
    protected $whitelist = ['admin/Admin/welcome','admin/Admin/index'];
    protected function initialize(){
        $module = Request::module(); //获取当前模块
        $controller = Request::controller();//获取当前控制器名称
        $action = Request::action();//获取当前方法名称
        $rules=$module.'/'.$controller.'/'.$action;  //组合  控制器/方法

        if(session('uid')!=1){  //不是超级管理员才进行权限判断
           if(!in_array($rules,$this->whitelist)){  // 是否在开放权限里面
                if(!session('uid')){  
                   $this->error('请先登陆系统！','Login/Login');
                }
                $res = (new \think\Auth())->check ($rules,\session('uid'));
                if(!$res){   // 第一个参数  控制/方法     第二个参数：当前登陆会员的id
                  $this->error('没有权限');
                };
            } 
         }
        // $uid = session('uid');
        // if (!$uid) {
        //      $this->error('还没有登录，正在跳转到登录页','login/login');
        // }
    }
    public function getUserId(){
        return session('uid');
    }
    public function getUserName(){
        return session('name');
    }
}
