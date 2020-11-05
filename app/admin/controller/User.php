<?php

namespace app\admin\controller;

use think\Loader;
use think\Controller;
use think\Request;
use think\DB;
class User extends Commth
{
    //配置白名单
    protected $whitelist = ['admin/User/userlist'];
    public function index()
    {
        return view();
    }
    public  function  userlist($page=1,$limit=10)
    {
        $username = $this->request->param('username');
        $data = db('user')
            ->where('status',1)
            ->where('name','LIKE',"%{$username}%")
            ->order('id asc')
            ->paginate([
            'page' => $page,
            'list_rows' => $limit
        ]);
        $count =  $data->total();
        $list =  $data->getCollection();
        //返回数据
        return ["code"=>"0","msg"=>"","count"=>$count,"data"=>$list];
    }
    public  function  del()
    {
        $id = input('post.id');
        $ini['status'] = 2;
        $ini['del_time'] = time();
        $rt = db('user')->where('id',$id)->update($ini);
        if($rt==0||$rt)
        {
            $arr['code'] = 1;
            
        }else{
            $arr['code'] = 2;
        }
        return $arr;
    }
    public  function  edit($id)
    {
        $arr = input('post.');
        if(!empty($arr))
        {
            $ini['name'] = $arr['name'];
            $ini['update_time'] = time();    
            $old = db('user')->field('name')->where('id',$id)->find();
            if($old['name']!=$arr['name'])
            {
                $ifhave = db('user')->where('name',$arr['name'])->where('status',1)->find();
                if(!empty($ifhave))
                {
                    return 3;
                }
            }
            $rt = db('user')->where('id',$id)->update($ini);
            if($rt==0||$rt){
                return 1;
            }else{
                return 2;
            }
        }else
        {
            $name = db('user')->field('name')->where('id',$id)->find();
            $this->assign('name',$name['name']);
            $this->assign('id',$id);
            return view();
        }
    }
    public  function  add()
    {
        $arr = input('post.');
        if(!empty($arr))
        {
            $ini['name'] = $arr['name'];
            $ini['create_time'] = time();
            $ifhave = db('user')->where('name',$arr['name'])->where('status',1)->find();
            if(!empty($ifhave))
            {
                return 3;
            }
            $rt = db('user')->insert($ini);
            if($rt){
                return 1;
            }else{
                return 2;
            }
         
        }else
        {
            return view();
        }
    }
}
