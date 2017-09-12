<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/11
 * Time: 19:34
 */

namespace app\admin\controller;

use houdunwang\model\Model;
use houdunwang\view\View;
use system\model\Admin;

class Entry extends Common
{
    public function index(){

        //加载模板文件
        return View::make();
    }
    /**
     * 修改密码
     * @return mixed
     */
    public function modify()
    {
        if(IS_POST){
            //调用自己model执行登录功能
            $res = (new Admin())->modify($_POST);
            //dd($res);//接收POST提交的数据
            //根据$res结果给模板页面进行响应(提示)
            if($res['code']){
                //成功
                //u('模块.控制器.方法')
                //如果没有写模块，默认当前模块
                //如果没有写控制器，默认当前模块当前控制器
                //修改密码成功后退出到首页
                //删除session变量
                session_unset ();
                //删除session文件
                session_destroy ();
                $this->setRedirect (u('entry.modify'))->message ($res['msg']);
            }else{
                //失败
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        return View::make();
    }
    public function  out(){
        //删除session变量
        session_unset ();
        //删除session文件
        session_destroy ();
        //成功提示
        header ('location:?s=admin/login/index');
        //$this->success ('退出成功','?c=index&a=login');
    }
}