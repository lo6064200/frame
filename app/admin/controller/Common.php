<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/11
 * Time: 19:34
 */
namespace app\admin\controller;

use houdunwang\core\Controller;

class Common extends Controller
{
    //__construct() 函数创建一个新的 SimpleXMLElement 对象。
    //如果成功，则该函数返回一个对象。如果失败，则返回 false。
    public function __construct()
    {
        //判断SESSION里面是否保存有admin_id
        //如果没有就执行以下代码
        if (!isset($_SESSION['id'])){
            //强制跳转到登录界面
            header('location:?s=admin/login/index');die;
        }
    }
}