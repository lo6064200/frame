<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/8
 * Time: 20:08
 */
//创建一个名为'houdunwang\view'的命名空间
//命名空间一个最明确的目的就是解决重名问题
namespace houdunwang\view;

class Base{
    //定义一个$data空数组
    //用于存放数据
    protected $data = [];
    //存放模板路径
    //用于调用模板
    protected $file;
    //创建一个with方法
    //用于分配变量
    public function with($var){
        //dd($var);
        //将$var的值赋予给数组来保存
        $this->data = $var;
        //返回值
        return $this;
    }
    //创建make方法
    //用于显示模板
    public function make(){
        //dd(MODULE);//home
        //dd(CONTROLLER);//Entry
        //dd(ACTION);//index
        //include "../app/home/view/entry/index.php";
        //组合生成模板路径
        $this->file =  "../app/".MODULE."/view/".strtolower (CONTROLLER)."/".ACTION."." . c('view.suffix');
        //将模板路径返回
        return $this;
    }

    /**
     * 当echo 输出对象的时候出发
     * @return string
     */
    public function __toString ()
    {
        //echo 1;
        //dd($this->data);
        //提取出$this->data的地址
        extract ($this->data);
        //调用地址
        include $this->file;
        //返回空值
        return '';
    }
}