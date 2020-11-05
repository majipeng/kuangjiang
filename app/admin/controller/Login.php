<?php

namespace app\admin\controller;

use think\Db;
use think\Model;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function login()
    {
        return view();
    }
    public function login_chack()
    {
        $arr = input('post.');
        if(!$arr){
            $code['code'] = 3;
            $code['msg'] = '账号密码必须填写！';
            return $code;
        }else{
            $admin = new Admin;
            $rt = $admin->loginchack($arr['name'],$arr['password']);
            if($rt['code']==1)
            {
                $code['code'] = 1;
                $code['msg'] = '登录成功';
            }else
            {
                $code['code'] = 2;
                $code['msg'] = '账号密码不正确';
              
            }
        }
        return $code;
    }
}
