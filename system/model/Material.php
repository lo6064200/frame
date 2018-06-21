<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/13
 * Time: 19:29
 */

namespace system\model;

use houdunwang\model\Model;
use Upload\Storage\FileSystem;
use Upload\File;
use Upload\Validation\Size;
class Material extends Model
{
    public function add(){
        //验证
        //$_FILES经由 HTTP POST 文件上传而提交至脚本的变量，类似于旧数组$HTTP_POST_FILES 数组
        $file = current ($_FILES);
        //值：0; 没有错误发生，文件上传成功。
        //值：1; 上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。
        //值：2; 上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。
        //值：3; 文件只有部分被上传。
        //值：4; 没有文件被上传。
        //如果错误码为4则说明没有上传文件
        if($file['error']==4) return ['code'=>0,'msg'=>'没有上传文件'];
        //调用上传方法
        $res = $this->upload ();
        //dd($res);
        //判断$res是否为空值
        if(!$res['code']) return ['code'=>0,'msg'=>$res['msg'][0]];
        //执行添加数据库
        $data = [
            'mpath'=>$res['path'],
            'mtime'=>time (),
        ];
        //insert执行数据的写入
        $this->insert($data);
        return ['code'=>1,'msg'=>'添加成功'];
    }
    public function upload(){
        //将文件上传到uploads文件中，将文件夹分为年/月/日来存储
        $dir = "uploads/" . date ('Y/m/d');
        //判断是否有该目录，如果有就存储，如果没有就创建后存储
        is_dir ($dir) || mkdir ($dir,0777,true);

        $storage = new FileSystem($dir);
        $file = new File('mpath', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations(array(
            // Ensure file is of type "image/png"
            //You can also add multi mimetype validation
            //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))
            // Ensure file is no larger than 5M (use "B", "K", M", or "G")
            new Size('5M')
        ));
        $data = array(
            'name'=> $file->getNameWithExtension(),
        );
        try {
            // Success!
            $file->upload();
            //将路径返回去
            return ['code'=>1,'msg'=>'','path'=>$dir . '/' . $data['name']];
        } catch (\Exception $e) {
            // Fail!
            $errors = $file->getErrors();
            return ['code'=>0,'msg'=>$errors];
        }
    }
}