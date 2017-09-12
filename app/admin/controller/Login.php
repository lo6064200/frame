<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/11
 * Time: 19:35
 */

namespace app\admin\controller;

use houdunwang\core\Controller;
use houdunwang\model\Model;
use houdunwang\view\View;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use system\model\Admin;
class Login extends Controller
{
    public function index(){
        //首先生成一个加密之后的密码，手动写入数据库中
        //dt(password_hash ('admin888',PASSWORD_DEFAULT));
        //测试连接数据库是否成功
        //$res = Admin::find(1);
        //dd($res);
        //测试c函数读取配置项
        //dd(c('database.host'));
        //测试u函数
        //dd (u('admin.entry.index'));//?s=admin/entry/index
        //dd (u('entry.index'));//?s=admin/entry/index
        //dd (u('index'));//?s=admin/entry/index
        //dd(u('index'));
        if(IS_POST){
            //调用自己model执行登录功能
            $res = (new Admin())->login($_POST);
            //dd($res);//接收POST提交的数据
            //根据$res结果给模板页面进行响应(提示)
            if($res['code']){
                //成功
                //u('模块.控制器.方法')
                //如果没有写模块，默认当前模块
                //如果没有写控制器，默认当前模块当前控制器
                $this->setRedirect (u('entry.index'))->message ($res['msg']);
            }else{
                //失败
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        return View::make();
    }
    /**
     * 加载验证码
     */
    public function captcha(){
        header('Content-type: image/jpeg');
        $phraseBuilder = new PhraseBuilder(4);
        $builder = new CaptchaBuilder(null,$phraseBuilder);
        $builder->build ();
        //将验证码存入到session
        $_SESSION['phrase'] = $builder->getPhrase();
        $builder->output ();
    }
}