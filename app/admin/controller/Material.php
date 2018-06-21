<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/13
 * Time: 19:10
 */

namespace app\admin\controller;
use houdunwang\view\View;
use system\model\Material as MaterialData;
class Material extends Common
{
    public function index(){
        //$url = u('add',['gid'=>1,'aid'=>2]);
        //dt($url);
        //将代码排序
        //以ID为关键词倒叙排序
        $model = MaterialData::getAll();
        //比较数据，如果有数据，将对象转为数组。如果没有数据，就传个空数组
        $data = $model ? $model->toArray() : [];
        //$data = [1,2,3];
        //dt(compact ('data'));
        //return View::make()->with(compact ('data'));
        //返回参数，调用模板
        return View::make()->with(compact ('data'));
    }
    public function add ()
    {
        if(IS_POST){
            //实例化一个类，调用POST参数
            $res = (new MaterialData())->add($_POST);
            //dt($res);
            //判断res是否有值
            if($res['code']){
                //如果有值执行setRedirect方法
                //访问index页面
                //返回$res信息
                $this->setRedirect (u('Index.class'))->message ($res['msg']);
            }else{
                //如果没有值则执行空值
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        return View::make();
    }
    public function del(){
        //接受删除的数据主键
        $mid = $_GET['mid'];
        //dt($mid);
        //删除服务器上对应的文件
        //find根据主键查找一条数据
        $data = MaterialData::find($mid)->toArray();
        //dd(file_exists ($data['mpath']));
        //file_exists() 函数检查文件或目录是否存在。
        //如果指定的文件或目录存在则返回 true，否则返回 false。
        if(file_exists ($data['mpath'])){
            //unlink() 函数删除文件
            //若成功，则返回 true，失败则返回 false
            unlink ($data['mpath']);
        }
        //destory删除删除主键值
        MaterialData::destory($mid);
        //返回index并提示
        $this->setRedirect (u('Index.class'))->message ('删除成功');
        //接受get参数
        //GradeModel::destory($mid);
        //$this->setRedirect (u('index'))->message ('删除成功');
    }
}