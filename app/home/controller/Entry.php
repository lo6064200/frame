<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/7
 * Time: 21:14
 */
//创建一个名为'app\home\controller'的命名空间
//命名空间一个最明确的目的就是解决重名问题
namespace app\home\controller;
//创建一个entry类来完成一些载入数据
use houdunwang\core\Controller;
use houdunwang\view\View;
use system\model\Article;

class Entry extends Controller{
    //定义一个index方法
    //用于调用输出
    public function index(){
        //调用成功则输出index
        //echo 'index';
        //静态调用Article
        //Article调用find(id)数据库类
        $data = Article::find (1);
        //打印id为1的数据内容
        //dd($data);
       //echo 'index';
        //让test等于houdunwnag
        //便于网页调用
        $test = 'houdunwang';
        //dd(compact ('a'));
        //Array
        //(
        //	[a] => houdunwang
        //)
        //dd(View::with(compact('test')));
        //return 输出一个静态方法with变量
        //调用make方法
        return View::with(compact('test'))->make();

    }
    //定义一个add方法
    //用于调用输出
    public function add(){
        //调用成功则输出add
        //echo 'add';
        //返回的$this
        //$this->setRedirect ();//接收到setRedirect();
        //$this->setRedirect ()->message ( '添加成功' );
    }
}