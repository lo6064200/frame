<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/13
 * Time: 23:19
 */

namespace app\admin\controller;

use houdunwang\view\View;
use system\model\Student as StudentData;
use system\model\Grade;
use \system\model\Material;
class Student extends Common
{
    public function index()
    {
        $data = [];
        //StudentModel::join('grade on s.cid=g.cid')->getAll()
        //多表查询
        //获得多张表的信息
        $data = StudentData::query("select * from student s join grade g on s.gid=g.gid join material m on m.mid=s.mid");
        //dd($data);
        //返回参数，调用模板
        return View::make()->with(compact('data'));
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        if (IS_POST) {
            //实例化一个类，调用POST参数
            $res = (new StudentData)->add($_POST);
            //dt($res);
            //判断res是否有值
            if ($res['code']) {
                //如果有值执行setRedirect方法
                //访问index页面
                //返回$res信息
                $this->setRedirect(u('Index.class'))->message($res['msg']);
            } else {
                //如果没有值则执行空值
                $this->setRedirect()->message($res['msg']);
            }
        }
        //获取头像数据
        $materialData = $this->getMaterialData();
        //获取班级数据
        $gradeData = $this->getGradeData();
        //返回参数，调用相应模板数据
        return View::make()->with(compact('materialData', 'gradeData'));

    }

    /**
     * 获取班级数据
     * @return array
     */
    private function getGradeData()
    {
        //获取grade表中的所有数据
        $data = Grade::getAll();
        //三元表达式
        //toArray(）将对象转为数组
        //用于判断$data是否有值,如果有值将对象转为数组，如果没值就返回一个空数组
        $data = $data ? $data->toArray() : [];
        //返回值
        return $data;
    }

    /**
     * 获取媒体素材数据
     * @return array
     */
    private function getMaterialData()
    {
        //获取material表中的所有数据
        $data = Material::getAll();
        //三元表达式
        //toArray(）将对象转为数组
        //用于判断$data是否有值,如果有值将对象转为数组，如果没值就返回一个空数组
        $data = $data ? $data->toArray() : [];
        //返回值
        return $data;
    }

    /**
     * @return mixed
     */
    public function edit()
    {
        //调用GET参数
        $sid = $_GET['sid'];
        //dd($sid);
        //判断POST是否有值
        if (IS_POST) {
            //实例化一个新值，传入$sid和POST值
            $res = (new StudentData)->edit($sid, $_POST);
            if ($res['code']) {
                //如果有值执行setRedirect方法
                //访问index页面
                //返回$res信息
                $this->setRedirect(u('Index.class'))->message($res['msg']);
            } else {
                //如果没有值则执行空值
                $this->setRedirect()->message($res['msg']);
            }
        }
        //获取头像数据
        $materialData = $this->getMaterialData();
        //获取班级数据
        $gradeData = $this->getGradeData();
        //获取旧数据
        $oldData = StudentData::find($sid)->toArray();
        //dd($oldData);
        //返回参数，调用相应模板数据（头像数据，班级数据，旧数据）
        return View::make()->with(compact('materialData', 'gradeData', 'oldData'));

    }

    public function del()
    {
        //得到GET传来的sid的值
        $sid = $_GET['sid'];
        //删除数据主键的值
        StudentData::destory($sid);
        //跳转并提示
        $this->setRedirect(u('Index.class'))->message('删除成功');
    }
}