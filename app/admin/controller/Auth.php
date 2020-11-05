<?php

namespace app\admin\controller;

use think\Loader;
use think\Controller;
use think\Request;
use think\Db;
class Auth extends Commth
{
    protected $whitelist = ['admin/Auth/authindex_list','admin/Auth/grouplist'];
    //***
    //***权限规则菜单
    //***增删改查
    //***
    public  function  authindex()
    {
        return view();
    }
    //规则权限列表接口
    public function authindex_list($page=1,$limit=10)
    {
        $title = $this->request->param('title');
        $data = db('auth_rule')
        ->where('title','LIKE',"%{$title}%")
        ->field('id,pid,title,name')
        ->order('id asc')
        ->where('status',1)
        ->select()
        ->toArray();
        $list = getTree($data);
        return ["code"=>"0","msg"=>"","count"=>"","data"=>$list];
    }
    //规则权限列表  添加页面
    public  function  authadd()
    {
        $arr = input('post.');
        if(!empty($arr))
        {
            $ini['pid'] = $arr['pid'];
            $ini['title'] = $arr['title'];
            $ini['name'] = $arr['name'];
            $ini['create_time'] = time();
            $info = db('auth_rule')->where('title',$arr['title'])->where('name',$arr['name'])->where('status',1)->find();
            if(!empty($info))
            {
                return 3;
            }
            $rt = db('auth_rule')->insert($ini);
            if($rt){
                return 1;
            }else{
                return 2;
            }
        }else
        {
            $data = db('auth_rule')
            ->field('id,pid,title,name')
            ->order('id asc')
            ->where('status',1)
            ->select()
            ->toArray();
            $list = getTreeT($data);
            $this->assign('list',$list);
        }
        return view();
        
    }
    //规则权限列表  编辑页面
    public  function  authedit($id)
    {
        $arr = input('post.');
        if(!empty($arr))
        {
            $ini['pid'] = $arr['pid'];
            $ini['title'] = $arr['title'];
            $ini['name'] = $arr['name'];
            $ini['update_time'] = time();
            $info = db('auth_rule')->where('title',$arr['title'])->where('name',$arr['name'])->where('status',1)->find();
            if(!empty($info))
            {
                return 3;
            }
            $rt = db('auth_rule')->where('id',$id)->update($ini);
            if($rt==0||$rt){
                return 1;
            }else{
                return 2;
            }
        }else
        {
            $data = db('auth_rule')
            ->field('id,pid,title,name')
            ->order('id asc')
            ->where('status',1)
            ->select()
            ->toArray();
            $list = getTreeT($data);

            $info = db('auth_rule')->where('id',$id)->find();
            $this->assign('info',$info);
            $this->assign('list',$list);
            $this->assign('id',$id);
        }
        return view();
    }
    //规则权限列表  删除
    public  function  authdel()
    {
        $id = input('post.id');
        $data = db('auth_rule')
            ->field('id,pid,title,name')
            ->order('id asc')
            ->where('status',1)
            ->select()
            ->toArray();
        $list = getTreeT($data,$id);
        $strid = '';
        foreach ($list as $key => $value) {
            $strid .=$value['id'].",";
        }
        $strid = $strid.$id;
        $ini['status'] = 2;
        $rt = db('auth_rule')->where('id','in',$strid)->update($ini);
        if($rt==0||$rt){
            $arr['code'] = 1;
        }else{
            $arr['code'] = 2;
        }
        return  $arr;
    }

    //***
    //***角色组菜单
    //***增删改查
    //***
    public function authgroup()
    {
        return view();
    }
    //角色组列表接口
    public  function  grouplist($page=1,$limit=10)
    {
        $title = $this->request->param('title');
        $data = db('auth_group')->where('status',1)
            ->where('title','LIKE',"%{$title}%")
            ->order('id asc')
            ->paginate([
            'page' => $page,
            'list_rows' => $limit
        ]);
        $list=$data->all();
        $count =  $data->total();
        $list =  $data->getCollection();
        //返回数据
        return ["code"=>"0","msg"=>"","count"=>$count,"data"=>$list];
    }
    //角色组添加
    public function groupadd()
    {
        $arr = input('post.');
        if(!empty($arr))
        {
            $ini['title'] = $arr['title'];
            $ini['rules'] = $arr['strid'];
            $ini['create_time'] = time();
            $ifhave = db('auth_group')->where('title',$arr['title'])->where('status',1)->find();
            if(!empty($ifhave)){
                return 3;
            }
            $rt = db('auth_group')->insert($ini);
            if($rt){
                return 1;
            }else{
                return 2;
            }
        }else
        {
            $data = db('auth_rule')
            ->field('id,pid,title as label')
            ->order('id asc')
            ->where('status',1)
            ->select()
            ->toArray();
            $list = generateTree($data);
            $datajson = json_encode($list,JSON_UNESCAPED_UNICODE);
            $this->assign('datajson',$datajson);
            return view();
        } 
    }
    //角色组编辑
    public function groupedit($id)
    {
        $arr = input('post.');
        if(!empty($arr))
        {
            $ini['title'] = $arr['title'];
            $ini['rules'] = $arr['strid'];
            $ini['update_time'] = time();

            $old = db('auth_group')->field('title')->where('id',$id)->find();
            if($old['title']!=$arr['title'])
            {
                $ifhave = db('auth_group')->where('title',$arr['title'])->where('status',1)->find();
                if(!empty($ifhave)){
                    return 3;
                }
            }
            $rt = db('auth_group')->where('id',$id)->update($ini);
            if($rt==0||$rt){
                return 1;
            }else{
                return 2;
            }
        }else
        {
            $data = db('auth_rule')
            ->field('id,pid,title as label')
            ->order('id asc')
            ->where('status',1)
            ->select()
            ->toArray();
            $info = db('auth_group')->field('title,rules')->where('id',$id)->find();
            $haveArr = explode(",", $info['rules']);

            //判断当前角色组ID都包括什么，设置选中
            foreach ($data as $key => $value) {
                if(in_array($value['id'],$haveArr))
                {
                    $data[$key]['checked'] = 'true';
                }
            }
            $list = generateTree($data);
            $datajson = json_encode($list,JSON_UNESCAPED_UNICODE);
            $this->assign('datajson',$datajson);
            $this->assign('id',$id);
            $this->assign('title',$info['title']);
            return view();
        }
    }
    //角色组删除
    public function groupdel()
    {
        $id = input('post.id');
        $ini['status'] = 2;
        $ini['del_time'] = time();
        $rt = db('auth_group')->where('id',$id)->update($ini);
        if($rt){
            $arr['code'] = 1;
        }else{
            $arr['code'] = 2;
        }
        return $arr;
    }
}
