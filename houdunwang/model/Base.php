<?php
//创建一个名为'houdunwang\model'的命名空间
//命名空间一个最明确的目的就是解决重名问题
namespace houdunwang\model;
//使用PDO
use PDO;
use PDOException;
use Exception;
//创建一个Base的类
//用于数据库的调用
class Base
{
    /**
     * 声明操作数据表
     *
     * @var string
     */
    protected $table;
    /**
     * pdo对象
     *
     * @var null
     */
    private static $pdo = null;
    /**
     * where条件
     *
     * @var
     */
    private $where = '';
    /**
     * 存放查询结构的数据
     *
     * @var
     */
    private $data;
    /**
     * 获取指定字段
     *
     * @var
     */
    private $field = '';
    /**
     * 排序
     * @var string
     */
    private $order = '';
    /**
     * Base constructor.
     *
     * @param $class
     */
    //__construct() 函数创建一个新的 SimpleXMLElement 对象。
    //如果成功，则该函数返回一个对象。如果失败，则返回 false。
    public function __construct ( $class )
    {
        //数据库连接
        //2.$pdo是一个静态变量，判断他是否为空来判断是否连接到了数据库
        if ( is_null ( self::$pdo ) ) {
            //静态调用connect方法
            //用于加载用户名和密码
            $this->connect ();
        }
        //把所有字符转换为小写：从字符串左侧移除字符：查找指定字符在字符串中的最后一次出现
        //转义\
        //dd(get_called_class());
        //dd($class);
        //得到数据库表名
        $info        = explode ( '\\' , $class );
        //将$info的值赋给$this->table
        //用于调用
        $this->table = strtolower ( $info[ 2 ] );
    }

    /**
     * 连接数据库
     * @throws Exception 抛出异常错误
     */
    //创建一个connect方法
    //登陆数据库
    private function connect ()
    {
        try {
            //数据库地址，数据库名
            $dsn       = c('database.driver').":host=".c('database.host').";dbname=".c('database.dbname');
            //数据库用户名
            $user      = c('database.user');
            //数据库密码
            $password  = c('database.password');
            //实例化一个类，链接数据库登录信息
            self::$pdo = new PDO( $dsn , $user , $password );
            //设置字符集
            self::$pdo->query ( 'set names utf8' );
            //设置错误属性
            self::$pdo->setAttribute ( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            //抛出错误信息
            throw new Exception( $e->getMessage () );
        }
    }
    /**
     * 统计数据
     * @return mixed	数据总数
     */
    public function count(){
        //1.拼接完整的查询sql语句
        //2.方便直接调用query()方法直接查询
        $sql = "select count(*) as total from {$this->table} {$this->where}";
        //执行sql语句
        //调用自己创建的query方法，查询语句
        $data =  $this->query ($sql);
        return $data[0]['total'];
    }
    /**
     * 排序
     * @param $order
     * @return $this
     */
    public function order($order){
        //order by gid desc
        $this->order= "order by " . $order;
        return $this;
    }
    /**
     * 获取制定字段
     *
     * @param $field ('title,time')
     *
     * @return $this
     */
    public function field ( $field )
    {
        //1.将指定查找的字段存入私有属性field中
        //2.方便可以在全局方法中调用
        $this->field = $field;
        //1.将这个类以对象形式返回
        //2.得到这个对象后可以调用里面已经定义过得属性
        return $this;
    }

    /**
     * 执行数据写入
     *
     * @param $data    要写入的数据
     *
     * @return mixed
     */
    public function insert ( $data )
    {
        //1.用来存储拼接标签名
        //2.将标签名拼接成一个完整的条件
        $fields = '';
        //1.用来存储拼接标签内容
        //2.将标签的内容拼接成一个完整的条件，对应拼接好的每一个标签名
        $values = '';
        //1.使用foreach循环遍历$data数组
        //2.得到需要添加内容的标签有哪些和每个标签相对应的内容
        foreach ( $data as $k => $v ) {
            //1.数组的键名为标签名，我们将他们用逗号拼接起来
            //2.方便写到sql语句中
            $fields .= $k . ',';
            //1.数组的键值为标签内容，我们将他们用逗号拼接起来
            //2.方便写到sql语句中
            //3.在拼接之前我们还需要判断这个内用是不是整形的，如果是整形的我们在拼接时就不能给他加上引号
            //4.因为如果是整形的说明这个标签在数据库中的类型为整形，加上单引号后会转换为string类型，在执行sql语句是会报错
            if ( is_int ( $v ) ) {
                $values .= $v . ',';
            } else {
                $values .= "'$v'" . ',';
            }
        }
        //1.在拼接完成后得到的语句最后面有个逗号，这个逗号我们不要使用rtrim将这个逗号去掉
        $fields = rtrim ( $fields , ',' );
        $values = rtrim ( $values , ',' );
        //1.测试拼接完成的语句是否符合要求
        //dd($fields);
        //dd($values);
        //1.拼接完成sql添加语句
        //2.方便我们直接调用exec方法来执行sql添加语句
        $sql = "insert into {$this->table} ({$fields}) values ({$values})";
        //1.测试输出拼接完成的语句是否符合要求
        //2.做好复制到cmd框里面执行以下
        //dd($sql);
        //1.调用我们自己创建的方法exec()，往数据库中添加数据
        //2.返回的是对里面的几条数据进行了操作
        //执行sql语句
        return $this->exec ( $sql );
    }

    /**
     * 执行更新数据
     *
     * @param array $data 更新的数据
     *
     * @return bool|mixed    受影响条数
     */
    public function update ( array $data )
    {
        //如果没有指定where条件不允许更新数据
        //不然数据库里面的数据会全部被更新
        if ( empty( $this->where ) ) {
            //返回false下面的代码不让他执行
            return false;
            //dd($data);die;
        }
        //声明空字符串，用来存储重组完成的结果：title='后盾网',time=10
        //方便写入sql语句中执行
        $fields = '';
        //1.使用foreach循环遍历$data数组
        //2.得到需要修改内容的标签有哪些和每个标签相对应的内容
        foreach ( $data as $k => $v ) {
            //1.数组的键值为标签内容，我们将他们用逗号拼接起来
            //2.方便写到sql语句中
            //3.在拼接之前我们还需要判断这个内用是不是整形的，如果是整形的我们在拼接时就不能给他加上引号
            //4.因为如果是整形的说明这个标签在数据库中的类型为整形，加上单引号后会转换为string类型，在执行sql语句是会报错
            if ( is_int ( $v ) ) {
                $fields .= "$k=$v" . ',';
            } else {
                $fields .= "$k='$v'" . ',';
            }
        }
        //最后侧,去掉
        //在拼接完成后得到的语句最后面有个逗号，这个逗号我们不要使用rtrim将这个逗号去掉
        $fields = rtrim ( $fields , ',' );
        //dd($fields);
        //1.测试拼接到的结果是不是我们想要的
        // dd($fields);
        //1.开始拼接完整的sql语句
        //2.可以放到sql中直接执行的
        $sql = "update {$this->table} set {$fields} {$this->where}";
        //1.测试拼接完的结果是否正确
        // dd($sql);
        //1.调用我们自己创建的方法exec()，往数据库中添加数据
        //2.返回的是对里面的几条数据进行了操作
        //执行sql语句
        return $this->exec ( $sql );
    }

    /**
     * 删除数据
     *
     * @param string $pk 删除主键值
     *
     * @return bool|mixed    受影响条数
     */
    public function destory ( $pk = '' )
    {
        //1.判断where条件是否为空
        //2.删除语句不能让where条件语句为空，因为这会把整个表的数据删除
        if ( empty( $this->where ) || empty( $pk ) ) {
            //测试是否执行到这里
            //dd(1);
            //1，如果where值为空，检测参数主键值是否为空
            //2.如果为空，就让他返回false，不能让他为空，不然会报错
            if ( empty( $this->where ) ) {
                //获取主键
                //得到主键值方便删除指定的那个主键值
                $priKey = $this->getPriKey ();
                //这个时候说明没有where条件
                //那么把destory传入参数作为where条件
                $this->where ( "{$priKey}={$pk}" );
            }
            //1.得到了where条件，我们来拼接完整的sql删除语句
            //2.方便后面调用我们自创建的exec（）方法对数据库进行操作
            $sql = "delete from {$this->table} {$this->where}";

            //执行sql语句
            return $this->exec ( $sql );
        } else {
            //dd($pk);
            //测试是否访问到了这里
            // dd(1);
            //1，如果where和主键值都为空，让他返回false
            //2.where和主键值都为空的话，会删除表里面所有的数据
            return false;
        }
    }

    /**
     * 获取所有数据
     *
     * @return $this|array
     */
    public function getAll ()
    {
        //1.在这个方法中声明一个变量用来存储查询的指定字段
        //2.使用三元表达式判断是否传入了指定的查询字段，如果没有，设置为*，查询所有
        $field = $this->field ? : '*';
        //组合查询所有数据的sql语句
        //通过query（）方法执行它
        //dd($this->where);
        $sql = "select {$field} from {$this->table} {$this->where}";
        //调用自定义的query查询
        //dd($sql);
        //执行查询
        $data = $this->query ( $sql );
        //1.使用if判断得到的结果是否为空
        //2.如果不为空执行if里面的代码

        if ( ! empty( $data ) ) {
            //测试是否执行到if里面
            //    dd(1);
            //3.将获取到的数据存到私有属性data里面
            $this->data = $data;
            //1.将这个类以对象的形式返回
            return $this;
        }

        return [];
    }

    /**
     * 根据主键查找一条数据
     * @param $pk 主键值
     * @return $this|array
     */
    public function find ( $pk )
    {
        //获取当前操作表的主键
        $priKey = $this->getPriKey ();
        //dd($priKey);
        //$sql = "select * from 表 where 主键=$pk";
        //组合where语句,调用where方法
        //为了把sql中where条件语句存储到where属性中
        $this->where ( "$priKey={$pk}" );
        $field = $this->field ? : '*';
        $sql = "select {$field} from {$this->table} {$this->where}";
        //调用我们自定义的query方法执行sql语句
        $data = $this->query ( $sql );
        if ( ! empty( $data ) ) {
            $this->data = current ( $data );

            return $this;
        }

        //return $this;

        return [];
    }

    /**
     * 将对象转为数组
     *
     * @return array    转之后的数组
     */
    public function toArray ()
    {
        if ( $this->data ) {
            return $this->data;
        }

        return [];
    }

    /**
     * sql查询语句中where条件
     *
     * @param $where    where条件
     *
     * @return $this
     */
    public function where ( $where )
    {
        //$this->where = "where sex='女' and age>20";
        $this->where = "where {$where}";

        return $this;
    }

    /**
     * 获取主键
     *
     * @return string    主键字段
     */
    public function getPriKey ()
    {
        //组合sql语句，为了查看表结构
        //为了在里面呢找主键
        $sql = "desc " . $this->table;
        //调用自定义的query方法进行查询
        $data = $this->query ( $sql );
        //dd($data);
        $priKey = '';//定义空字符串用来存储主键
        foreach ( $data as $v ) {
            if ( $v[ 'Key' ] == 'PRI' ) {
                //说明是主键
                $priKey = $v[ 'Field' ];
                break;
            }
        }

        return $priKey;
    }

    /**
     * 执行查询
     *
     * @param $sql    查询的sql语句
     *
     * @return mixed
     * @throws Exception
     */
    public function query ( $sql )
    {
        try {
            //调用pdoquery
            $res = self::$pdo->query ( $sql );

            return $res->fetchAll ( PDO::FETCH_ASSOC );
        } catch ( PDOException $e ) {
            throw new Exception( $e->getMessage () );
        }
    }

    /**
     * 执行没有结果集的sql
     *
     * @param $sql    sql语句
     *
     * @return mixed
     * @throws Exception
     */
    public function exec ( $sql )
    {
        try {
            $res = self::$pdo->exec ( $sql );
            //如果是添加的话，获取返回的自增主键值
            if ( $lastInsertId = self::$pdo->lastInsertId () ) {
                //说明有返回的自增id
                return $lastInsertId;
            }

            return $res;
        } catch ( PDOException $e ) {
            throw new Exception( $e->getMessage () );
        }
    }
}
