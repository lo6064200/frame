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
        $model = GradeModel::order("gid desc")->getAll();
        $data = $model ? $model->toArray() : [];
        //$data = [1,2,3];
        //dt(compact ('data'));
        //return View::make()->with(compact ('data'));
        return View::make()->with(compact ('data'));
    }

    public function add ()
    {
        if(IS_POST){
            $res = (new GradeModel())->add($_POST);
            //dt($res);
            if($res['code']){
                $this->setRedirect (u('index'))->message ($res['msg']);
            }else{
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        return View::make();
    }

    public function edit ()
    {
        $gid = $_GET['gid'];
        if(IS_POST){
            $res = (new GradeModel())->edit($gid,$_POST);
            if($res['code']){
                $this->setRedirect (u('index'))->message ($res['msg']);
            }else{
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
        $this->setRedirect (u('index'))->message ('删除成功');
    }
}