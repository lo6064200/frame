<?php
//创建一个名为'app\home\controller'的命名空间
//命名空间一个最明确的目的就是解决重名问题
namespace app\home\controller;
//1，声明类app\home\controller\Entry
//2,测试在地址栏传入不同的参数调用不同目录中不同命名空间里的类
use houdunwang\core\Controller;
//1,因为在方位不存在的方法是要用到这个路径下和这个命名空间下的View里面的方法，所以在这里需要使用use加载它的命名空间
//2,composer.json里面已经加载了他的目录路径
use houdunwang\view\View;
//1,因为在方位不存在的方法是要用到这个路径下和这个命名空间下的Article里面的方法，所以在这里需要使用use加载它的命名空间
//2,composer.json已结加载了目录路径
use system\model\Article;

class Entry extends Controller
{
    //定义一个index方法
    //用于调用输出
    public function index ()
    {
        //测试抛出异常加载第三方类库
        //include 'a';
        //Article::query('aaa');
        //***************测试数据库根据主键查找单一一条数据***************//
        //$data = Article::find ( 1 );
        //dd($data);//打印出来是obj
        //$data = Article::find ( 1 )->toArray ();
        //dd($data);
        //***************where条件查找数据***************//
        //$data = Article::where("time=10 and aid=7")->getAll()->toArray();
        //dd($data);
        //***************测试查询所有数据***************//
        //$data = Article::getAll ()->toArray ();
        //dd($data);
        //***************使用原生方式查询所有数据***************//
        //$data = Article::query('select * from student');
        //dd($data);
        //***************测试删除数据***************//
        //$res = Article::where('title="aaaa" and sex="女"')->destory();
        //$res = Article::destory(1);
        //dd($res);
        //***************测试数据更新***************//
        //$data = [
        //	'atitle' => '后盾人修改1111' ,
        //	'time'  => 1011 ,
        //];
        //title='后盾人',time=10
        //$res  = Article::where("aid=2")->update ($data);
        //dd($res);
        //***************测试数据新增***************//
        //$data = [
        //    'atitle' => '后盾人修改1111' ,
        //   'time'  => 1011 ,
        //];
        //$res = Article::insert($data);
        //dd($res);
        //***************测试获取制定字段***************//
        //$data = Article::field('atitle,time')->getAll()->toArray();
        //$data = Article::getAll()->toArray();
        //$data = Article::field('atitle')->find(2)->toArray();
        //dd($data);
        //***************测试统计***************//
        //$count = Article::count();
        //$count = Article::where("time=0")->count();
        //dd($count);
        //************************测试排序*************************************
        //1,调用base里面的order方法,必须传入一个排序字段，不然会报错
        //2,返回排序好的数组
        //$data = Article::order('id');
        //1,输出这个排序好的数组
        //dd($data);
        return View::make ();
        //$sql='1111111';
        //dd($sql);

    }

    public function add ()
    {
        //测试Controller.php中setRedirect和message方法
        //$this->setRedirect ()接收到setRedirect()返回的$this
        //$this->setRedirect ()->message ( '添加成功' );
    }
}