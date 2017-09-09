<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/8
 * Time: 21:34
 */
//创建一个IndexController类
//用于类名的调用
class IndexController{
    public function index(){
        //get_called_class()获取当前主调类的类名
        //用于返回当前主调用的类名
        echo get_called_class();
    }
}
//(new IndexController())->index();
//创建一个son的类，并且继承IndexController
class son extends IndexController{

}
//实例化son类
//加载index类
(new Son())->index();