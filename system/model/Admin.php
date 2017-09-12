<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/11
 * Time: 20:25
 */

namespace system\model;


use houdunwang\model\Model;

class Admin extends Model
{
    public function login($data){
        $admin_username = $data['admin_username'];
        $admin_password = $data['admin_password'];
        $captcha = $data['captcha'];
        //数据验证
        //return ['code'=>0,'msg'=>'请输入用户名']
        //code 标识成功还是失败的标识 1代表成功，0代表失败
        //msg 提示消息
        if(!trim($admin_username)) return['code'=>0,'msg'=>'用户名不能为空'];
        if(!$admin_password) return['code'=>0,'msg'=>'密码不能为空'];
        if(!trim($captcha)) return['code'=>0,'msg'=>'请填写验证码'];
        //比对用户名密码是否正确
        //根据用户提交的username在数据库进行查找
        $userInfo = $this->where("username='{$admin_username}'")->getAll();
        //如果找不到数据，说明当前用户不存在
        //dt($userInfo);
        if(!$userInfo) return['code'=>0,'msg'=>'用户名或密码不正确，请重新输入！'];
        //走到这说明$userInfo一定有数据
        //比对密码
        $userInfo = $userInfo->toArray();
        //dd($password);
        if(!password_verify ($admin_password,$userInfo[0]['password'])) return ['code'=>0,'msg'=>'用户名或密码不正确，请重新输入！'];
        //走到这里说明账号密码都正确
        //比对验证码是否正确
        if(strtolower ($captcha) != strtolower ($_SESSION['phrase'])) return ['code'=>0,'msg'=>'验证码不正确'];
        //登录成功
        //将用户登录信息存储到session中
        $_SESSION['id'] = $userInfo[0]['id'];
        $_SESSION['username'] = $userInfo[0]['username'];
        //返回成功标识和成功提示信息
        return ['code'=>1,'msg'=>'登录成功'];
    }
    /**
     * 修改密码
     * @param $data 提交的数据
     * @return array
     */
    public function modify($data)
    {
        //获取用户名
        //dt($id);
        $id = $_SESSION['id'];
        //旧密码
        $password=$data["xj_password"];
        //新密码
        $xj_password=$data["xg_password"];
        //二次新密码
        $xj_password1=$data["xg_password1"];
        //判断是否输入了旧密码
        if (!$password) return ["code" => 0, "msg" => "请输入旧密码"];
        //根据用户提交的username在数据库进行查找
        $userInfo = $this->where("id='{$id}'")->getAll();
        //比对密码
        $userInfo = $userInfo->toArray();
        //判断旧密码是否正确
        if(!password_verify ($password,$userInfo[0]['password'])) return ['code'=>0,'msg'=>'请输入正确的旧密码！'];
        //判断是否输入了新密码
        if (!$xj_password) return ["code" => 0, "msg" => "请输入新密码"];
        //判断是否再次输入了密码
        if (!$xj_password) return ["code" => 0, "msg" => "请再次输入新密码"];
        //判断两次密码是否一致
        if($xj_password!=$xj_password1) return ["code"=>0,"msg"=>"请输入两次正确的密码！"];
        //重组数据
        $info = ["password"=>password_hash ($xj_password,PASSWORD_DEFAULT), ];
        //执行修改
        $this->where("id='{$id}'")->update($info);
        //成功提示
        return ["code" => 1, "msg" => "修改成功"];
    }
}