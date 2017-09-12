<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/7
 * Time: 19:44
 */
//创建一个名为'houdunwang\core'的命名空间
//命名空间一个最明确的目的就是解决重名问题
namespace houdunwang\core;
//创建一个 Boot类
//用于调用框架
class Boot{
    /**
     * 执行应用
     */
    //创建一个公开的run方法
    //用于完成框架的初始化
    public static function run(){
        //抛出异常
        self::handler();
        //echo 1;
        //dd(1);
        //初始化框架
        //用静态方法调用init()方法
        self::init();
        //执行应用
        //用静态方法调用下面的appRun()方法
        self::appRun();
    }
    private static function handler(){
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
    /**
     * 执行应用
     */
    //创建一个公开的appRun方法
    //用于完成地址栏参数的调用
    public static function appRun(){
        //地址栏有s参数
        //判断地址栏内是否有s参数
        if (isset($_GET['s'])){
            //home/entry/index:模块/控制器/方法
            //dd($_GET['s']);
            //explode() 函数把字符串打散为数组。
            //通过数组把地址拼接在一起
            $info = explode('/',$_GET['s']);
            //dd(info);
            //输出$class 拼接完成的地址传输出来
            //类名首字母大写，如Entry，一个\可以转义{}，因此这里需要加上两个\\阻止转义
            $class = "\app\\{$info[0]}\controller\\" . ucfirst( $info[1]);
            //获取数组里的index方法
            //用于具体制定访问地址
            $action = $info['2'];
            //dd($info);
            //定义常量
            //用于组合路径
            define('MODULE',$info[0]);
            define('CONTROLLER',$info[1]);
            define('ACTION',$info[2]);
        }else{//地址栏没有s参数，需要给默认值
            //默认调用的类是app目录下的home里面的类
            $class = "\app\home\controller\Entry";
            //获取数组里的index方法
            //用于具体制定访问地址
            $action = 'index';
            //定义常量
            //用于组合路径
            define('MODULE','home');
            define('CONTROLLER','entry');
            define('ACTION','index');
        }
        //实例化$class的类
        //调用$action[]的方法,输出对象
        echo call_user_func_array ( [ new $class , $action ] , [] );
        //(new $class）->$action();
    }
    /**
     * 初始化框架
     */
    public static function init(){
        //1.声明头部
        //2.如果不加头部，浏览器就会输出乱码
        header ( 'Content-type:text/html;charset=utf8' );
        //1.设置时区
        //2.不设置时区，使用时间的时候可能会出现时间不正确
        date_default_timezone_set ( 'PRC' );
        //1.开始session
        //2.使用session必须开启，如果有session_id则不再重复开启session
        session_id () || session_start ();
    }
}