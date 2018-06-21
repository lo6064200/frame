<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/12
 * Time: 16:20
 */

namespace app\admin\controller;

use houdunwang\view\View;
use system\model\Grade as GradeModel;

class Grade extends Common
{
    public function index ()
    {
        //$url = u('add',['gid'=>1,'aid'=>2]);
        //$url = u('add');
        //index.php?s=admin/grade/add&gid=1
        //dt($url);
        //将代码排序
        //以ID为关键词倒叙排序
        $model = GradeModel::order("gid desc")->getAll();
        //比较数据，如果有数据，将对象转为数组。如果没有数据，就传个空数组
        $data = $model ? $model->toArray() : [];
        //$data = [1,2,3];
        //dt(compact ('data'));
        //return View::make()->with(compact ('data'));
        //返回参数，调用模板
        return View::make()->with(compact ('data'));
    }

    public function add ()
    {
        if(IS_POST){
            //实例化一个类，调用GET参数
            $res = (new GradeModel())->add($_POST);
            //dt($res);
            //判断res是否有值
            if($res['code']){
                //如果有值执行setRedirect方法，调用index
                $this->setRedirect (u('Index.class'))->message ($res['msg']);
            }else{
                //如果没有值则执行空值
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        return View::make();
    }

    public function edit ()
    {
        //调用gid
        $gid = $_GET['gid'];
        if(IS_POST){
            //实例化一个新值，传入$id和POST值
            $res = (new GradeModel())->edit($gid,$_POST);
            if($res['code']){
                //如果有值执行setRedirect方法，调用index
                $this->setRedirect (u('Index.class'))->message ($res['msg']);
            }else{
                //如果没有值则执行空值
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        //获取旧数据
        $oldData = GradeModel::find($gid)->toArray();
        //dd($oldData);
        return View::make()->with(compact ('oldData'));
    }

    public function del ()
    {
        //接受get参数
        $gid = $_GET['gid'];
        GradeModel::destory($gid);
        $this->setRedirect (u('Index.class'))->message ('删除成功');
    }
}