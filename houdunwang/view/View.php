<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/8
 * Time: 19:57
 */

namespace houdunwang\view;

class View{
    /**
     * 普通调用的方法不存在时开始请求
     * @param $name 不存在的方法名
     * @param $arguments 方法的参数
     * @return mixed
     */
    public function __call ( $name , $arguments )
    {
        //在普通调用方法不存在执行以下代码
        //调用parseAction方法
        return self::parseAction ($name,$arguments);
    }
    /**
     * 当静态调用的方法不存在的时候开始请求
     * @param $name 不存在的方法名称
     * @param $arguments 方法的参数
     * @return mixed
     */
    public static function __callStatic ( $name , $arguments )
    {
        //在静态调用调用方法不存在执行以下代码
        //调用parseAction方法
        return self::parseAction ($name,$arguments);
    }

    /**
     * 自定义的方法
     * @param $name 方法名称
     * @param $arguments 方法的参数
     * @return mixed
     */
    public static function parseAction($name,$arguments){
        //call_user_func_array — 调用回调函数，并把一个数组参数作为回调函数的参数
        //实例化类Base，用于调用
        return call_user_func_array ([new Base,$name],$arguments);
    }
}