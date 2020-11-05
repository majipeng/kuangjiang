<?php

namespace app\admin\controller;

use think\Loader;
use think\Controller;
use think\Request;
use think\DB;
class Admin extends Commth
{
    //配置白名单
    protected $whitelist = ['admin/Admin/userlist','admin/Admin/welcome','admin/Admin/index'];
    public  function  welcome()
    {
        return view();
    }
    public function index()
    {
        if($this->getUserName()=='admin')
        {
            $infolist = db('auth_rule')->field('name')->select()->toArray();
            $newArr = array();
            foreach ($infolist as $key => $value) {
                $newArr[$key] = $value['name'];
            }
        }else
        {
            $info = db('auth_group_access')->alias('a')->field('g.rules')->join('auth_group g','g.id = a.group_id')->where('a.uid',session('uid'))->find();
            $infolist = db('auth_rule')->field('name')->where('id','in',$info['rules'])->select()->toArray();
            $newArr = array();
            foreach ($infolist as $key => $value) {
                $newArr[$key] = $value['name'];
            }
        }
       
        $this->assign('newArr',$newArr);
        $this->assign('username',$this->getUserName());
        return view();
    }
    public  function  user()
    {
        return view();
    }
    public  function  userlist($page=1,$limit=10)
    {
        $username = $this->request->param('username');
        $data = db('admin')
            ->alias('a')
            ->field('a.id,a.name,g.title')
            ->join('auth_group_access ac','ac.uid = a.id','LEFT')
            ->join('auth_group g','ac.group_id = g.id','LEFT')
            ->where('a.status',1)
            ->where('a.name','LIKE',"%{$username}%")
            ->order('a.id asc')
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
        $rt = db('admin')->where('id',$id)->update($ini);
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
            Db::startTrans();
            try {
                $old = db('admin')->field('name')->where('id',$id)->find();
                if($old['name']!=$arr['name'])
                {
                    $ifhave = db('admin')->where('name',$arr['name'])->where('status',1)->find();
                    if(!empty($ifhave))
                    {
                        return 3;
                    }
                    db('admin')->where('id',$id)->update($ini);
                }
                $old_group = db('auth_group_access')->field('group_id')->where('uid',$id)->find();
                if($old_group['group_id']!=$arr['group_id'])
                {
                    $newini['group_id'] = $arr['group_id'];
                    db('auth_group_access')->where('uid',$id)->update($newini);
                }
                // 提交事务
                Db::commit();
                return 1;
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();                
                return 2;
            }
        }else
        {
            $name = db('admin')->field('name')->where('id',$id)->find();
            $group_id = db('auth_group_access')->field('group_id')->where('uid',$id)->find();
            $list = db('auth_group')->where('status',1)->select();
            $this->assign('list',$list);
            $this->assign('name',$name['name']);
            $this->assign('group_id',$group_id['group_id']);
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
            $ini['password'] = md5($arr['password']);
            $ini['password_translation'] = $arr['password'];
            $ini['create_time'] = time();    

            $ifhave = db('admin')->where('name',$arr['name'])->where('status',1)->find();
            if(!empty($ifhave))
            {
                return 3;
            }
            Db::startTrans();
            try {
                $uid = db('admin')->insertGetId($ini);
                $newini['uid'] = $uid;
                $newini['group_id'] = $arr['group_id'];
                $rt = db('auth_group_access')->insert($newini);
                // 提交事务
                Db::commit();
                return 1;
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();                
                return 2;
            }
        }else
        {
            $list = db('auth_group')->where('status',1)->select();
            $this->assign('list',$list);
            return view();
        }
    }
    public  function  savepassword()
    {
        $id = input('post.id');
        $ini['password'] = md5('000000');
        $ini['password_translation'] = '000000';
        $rt = db('admin')->where('id',$id)->update($ini);
        if($rt==0||$rt)
        {
            return 1;
        }else{
            return 2;
        }
    }
}
