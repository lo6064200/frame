<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/12
 * Time: 16:18
 */

namespace system\model;

use houdunwang\model\Model;
class Grade extends Model
{
    public function add($data){
        //1.验证数据不能为空
        if(!trim($data['gname'])) return['code'=>0,'msg'=>'班级名称不能为空'];
        //1.验证班级人数不能为空
        if(!trim($data['number'])) return['code'=>0,'msg'=>'班级人数不能为空'];
        //1.验证班级人数不能为空
        if(!trim($data['teacher'])) return['code'=>0,'msg'=>'班主任名称不能为空'];
        //2.验证班级名称是否重复
        $gradeData = $this->where("gname='{$data['gname']}'")->getAll();
        if($gradeData) return ['code'=>0,'msg'=>'班级已经存在，请勿重复添加'];
        //执行添加
        $this->insert($data);
        return['code'=>1,'msg'=>'添加成功'];
    }
    public function edit($gid,$data){
        //dt($data);
        //1.验证数据不能为空
        if(!trim($data['gname'])) return['code'=>0,'msg'=>'班级名称不能为空'];
        //1.验证班级人数不能为空
        if(!trim($data['number'])) return['code'=>0,'msg'=>'班级人数不能为空'];
        //1.验证班级人数不能为空
        if(!trim($data['teacher'])) return['code'=>0,'msg'=>'班主任名称不能为空'];
        //2.验证班级名称是否重复
        $gradeData = $this->where("gname='{$data['gname']}' and gid !={$gid}")->getAll();
        if($gradeData) return ['code'=>0,'msg'=>'班级已经存在，请勿重复添加'];
        //3.执行更新
        $res = $this->where("gid={$gid}")->update($data);
        if($res){
            return ['code'=>1,'msg'=>'更新成功'];
        }
        return ['code'=>0,'msg'=>'数据未更新'];
    }
}