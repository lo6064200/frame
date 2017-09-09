<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/8
 * Time: 19:51
 */

namespace houdunwang\core;


class Controller
{
    //定义属性地址属性
    private $url = "window.history.back()";

    /**
     * 提示消息
     * @param $message
     */
    public function message($message){
        //加载public/view/message.php文件
        //消息提示的模板文件
        include "./view/message.php";
        //结束程序运行
        exit;
    }

    /**
     * 提示消息
     * @param string $url 跳转地址
     * @return $this
     */
    //创建一个自定义的方法
    //让url地址为空
    public function setRedirect($url = ''){
        //empty — 检查一个变量是否为空
        //判断url地址是否为空
        if (empty($url)){
                //如果为空就返回上一页
                $this->url = "window.history.back()";
        }else{
             //如果不为空就访问url页面
             $this->url = "location.href='$url'";
        }
        //返回当前的值
        return $this;
    }
}