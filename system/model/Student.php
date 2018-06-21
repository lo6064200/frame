<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/13
 * Time: 23:20
 */

namespace system\model;
use houdunwang\model\Model;

class Student extends Model
{
    public function add($data){
        //dd($data);
        //验证
        //判断姓名是否为空
        if(!trim ($data['sname'])) return ['code'=>0,'msg'=>'请输入姓名'];
        //判断性别是否为空
        if(!isset($data['ssex'])) return ['code'=>0,'msg'=>'请选择性别'];
        //判断头像是否选择
        if(!isset($data['mid'])) return ['code'=>0,'msg'=>'请选择头像'];
        //判断年龄是否为空
        if(!trim ($data['sage'])) return ['code'=>0,'msg'=>'请输入年龄'];
        //判断是否选择班级
        if(!$data['gid']) return ['code'=>0,'msg'=>'请选择班级'];
        //写入数据库
        //insert执行写入数据
        $this->insert($data);
        //成功提示
        return ['code'=>1,'msg'=>'添加成功'];
    }

    public function edit($sid,$data){
        //数据验证
        //判断姓名是否为空
        if(!trim ($data['sname'])) return ['code'=>0,'msg'=>'请输入姓名'];
        //判断性别是否为空
        if(!isset($data['ssex'])) return ['code'=>0,'msg'=>'请选择性别'];
        //判断头像是否选择
        if(!isset($data['mid'])) return ['code'=>0,'msg'=>'请选择头像'];
        //判断年龄是否为空
        if(!trim ($data['sage'])) return ['code'=>0,'msg'=>'请输入年龄'];
        //判断是否选择班级
        if(!$data['gid']) return ['code'=>0,'msg'=>'请选择班级'];
        //更新数据库
        //sql查询语句中where条件
        //update执行更新数据
        $this->where("sid={$sid}")->update($data);
        //成功提示
        return ['code'=>1,'msg'=>'编辑成功'];
    }
}