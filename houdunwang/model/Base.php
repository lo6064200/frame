<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/8
 * Time: 21:50
 */
//创建一个名为'houdunwang\model'的命名空间
//命名空间一个最明确的目的就是解决重名问题
namespace houdunwang\model;
//使用PDO
use PDO;
//使用PODException
use PDOException;
//使用Exception
use Exception;
//创建一个Base的类
//用于数据库的调用
class Base
{
    //创建一个$pdo方法
    //让$pdo的初始值为空
    private static $pdo = null;
    //操作数据表名
    private $table;
    //__construct() 函数创建一个新的 SimpleXMLElement 对象。
    //如果成功，则该函数返回一个对象。如果失败，则返回 false。
    public function __construct ($class)
    {
        //1.连接数据库
        //2.检测是否为空
        if(is_null (self::$pdo)){
            //静态调用connect方法
            //用于加载用户名和密码
            self::connect ();
        }
        //把所有字符转换为小写：从字符串左侧移除字符：查找指定字符在字符串中的最后一次出现
        //转义\
        $info = strtolower (ltrim (strrchr ($class,'\\'),'\\'));
        //将$info的值赋给$this->table
        //用于调用
        $this->table = $info;
    }
    /**
     * 连接数据库
     * @throws Exception	抛出异常错误
     */
    //创建一个connect方法
    //登陆数据库
    private static function connect ()
    {
        try {
            //数据库地址，数据库名
            $dsn      = c('database.driver').":host=".c('database.host').";dbname=".c('database.dbname');
            //数据库用户名
            $user     = c('database.user');
            //数据库密码
            $password = c('database.password');
            //实例化一个类，读取数据库登录信息
            self::$pdo      = new PDO( $dsn , $user , $password );
            //设置字符集
            self::$pdo->query ('set names utf8');
            //设置错误属性
            self::$pdo->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch ( PDOException $e ) {
            //抛出错误信息
            throw new Exception($e->getMessage ());
        }
    }
    //创建一个find方法
    //用于访问数据库，调用信息
    public function find ($id)
    {
        //先获取主键，获取当前操作的数据表的主键到底是谁
        $pk = $this->getPk();
        //dd($this->table);
        //查询数据库的id
        $sql = "select * from {$this->table} where {$pk} = {$id}";
        //dd($sql);
        //执行查询
        $data = $this->query ($sql);
        //dd($data);
        //将查询信息返回
        return current ($data);
    }
    /**
     * 获取表主键到底是id还是aid还是cid
     */
    private function getPk(){
        //查看表结构
        $sql = "desc " . $this->table;
        //获取具体表的信息
        $data  = $this->query ($sql);
        //dd($data);
        //定义$pk为空
        $pk = '';
        //循环遍历数据表的信息
        foreach($data as $v){
            //获取健名和健值
            if($v['Key'] == 'PRI'){
                //将健值赋值给$pk
                $pk = $v['Field'];
                //结束循环
                break;
            }
        }
        //返回$pk内容
        return $pk;
    }
    /**
     * 执行有结果集的查询
     */
    public function query($sql){
        try{
            //将$pdo->query($sql)得到的值赋予$res
            //用于调用结果集
            $res = self::$pdo->query($sql);
            //去除结果集
            return $row = $res->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            //抛出错误信息
            throw new Exception($e->getMessage ());
        }
    }
}