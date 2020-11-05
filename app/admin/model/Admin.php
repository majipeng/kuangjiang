<?php

namespace app\admin\model;

use think\Db;
use think\Controller;
use think\Model;
class Admin extends Model
{
    public function loginchack($name,$password)
    {
        $info = db('admin')->where('name',$name)->where('status',1)->where('password',md5($password))->find();
        if($info)
        {
            session('name',$name);
            session('uid',$info['id']);
            $code['code'] = 1;
            $code['msg'] = '账号密码正确';
        }else{
            $code['code'] = 2;
            $code['msg'] = '账号密码错误';
        }
        return $code;
    }
}
