<?php
/**
 * 助手函数
 */

/**
 * 定义常量判断是否为post请求
 */
define ('IS_POST',$_SERVER['REQUEST_METHOD']=='POST'?true:false);

/**
 * 检测请求是否为ajax请求
 */
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'){
    //是异步请求
    define ('IS_AJAX',true);
}else{
    define ('IS_AJAX',false);
}

if(!function_exists ('dd')){
    /**
     * 打印函数
     */
    function dd($var){
        echo '<pre style="background: #ccc;padding: 8px;border-radius: 5px">';
        //print_r打印函数，不显示数据类型
        //print_r不能打印null，boolen
        if(is_null ($var)){
            var_dump ($var);
        }elseif(is_bool ($var)){
            var_dump ($var);
        }else{
            print_r ($var) ;
        }
        echo '</pre>';
    }
}
if(!function_exists ('c')){
    /**
     * 读取配置项的c函数
     * @param $var
     *
     * @return null
     */
    function c($var)
    {
        //dd($var);//database.driver//database.host//database.dbname//database.user//database.password
        $info = explode ('.',$var);
        //dd($info);
        //Array
        //(
        //    [0] => database
        //    [1] => host
        //)
        $data = include "../system/config/".$info[0].".php";
        //dd($data);die;
        return isset($data[$info[1]]) ? $data[$info[1]] : null;
    }
}



