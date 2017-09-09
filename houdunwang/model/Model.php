<?php
//创建一个名为'houdunwang\model'的命名空间
//命名空间一个最明确的目的就是解决重名问题
namespace houdunwang\model;

class Model
{
    //定义一个普通的调用方法
    //用于判断普通调用的方法是否存在
    public function __call ( $name , $arguments )
    {
        //如果不存在就执行下面的语句
        //静态调用parseAction方法
        return self::parseAction ( $name , $arguments );
    }
    //定义一个静态的调用方法
    //用于判断静态调用的方法是否存在
    public static function __callStatic ( $name , $arguments )
    {
        //如果不存在就执行下面的语句
        //静态调用parseAction方法
        return self::parseAction ( $name , $arguments );
    }
    //创建一个方法
    //用于执行语句
    public static function parseAction ( $name , $argument )
    {
        //dd(get_called_class ());//返回当前调用的类名
        //get_called_class():获取静态绑定后的类名
        $class = get_called_class ();
        //call_user_func_array — 调用回调函数，并把一个数组参数作为回调函数的参数
        //实例化类Base，用于调用
        return call_user_func_array ( [ new Base($class) , $name ] , $argument );
    }
}