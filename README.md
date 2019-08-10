HzhihePHP 框架 基本说明

// Index          入口说明

/************************************************
 * Hzhihe PHPMVC - HZP 1.0
 * php.hzhihe.com
 * @param Object $hzhihe 总线程
 * Update:2017-04-23
 */

// 带 * 号的为必设置项 

/**入口文件**/
          
//网站开关(未写入，默认开启)
define ('WEB_SWITCH',true);

// 应用目录为当前目录
define('APP_PATH', __DIR__.'/');

// 会话控制(未写入，默认开启)
define ('WEB_SESSION',true);

// 伪静态文件开关(默认开启)
define('WEB_HTACCESS',true);

// 开启调试模式(默认开启)
define('APP_DEBUG', true);

// 加载框架
include APP_PATH . 'HzhihePHP/HzhihePHP.php';

      
// ---------------------------------------

// .htaccess      文件说明

    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^(.*)$ index.php?/=$1 [PT,NC]
    </IfModule>

// ---------------------------------------

// Controller      控制器说明


    类名称需与文件名一致,且继承 框架控制器类

    例：
        文件名：IndexController.class.php

    class IndexController extends Controller{}


// ---------------------------------------

// Model	    模型说明

    类名称需与文件名一致,且继承 框架模型类

    例：
    文件名：IndexModel.class.php

    class indexModel extends Model{}

// ---------------------------------------

// 控制器使用说明	

    /************************************************
     *
     * 控制器数据层 (C)
     * @param  assign        分配变量
     * @param  render        渲染视图
     *
     ************************************************/

// assign	分配变量使用方法

    /**
     * 分配变量文件
     * @param $name   变量名
     * @param	$value  变量内容
     */

    //	assign($name, $value)

    用 $this-> 来打开自定义类文件 assign('变量', 变量数据); 然后存入到变量 $data 当中。

    例：
    $centent = '我是内容';
    $data = $this->assign('index',$centent);

    视图视图页输出数据
    <?php echo $index; ?>

// view	渲染视图使用方法

    /**
     * 渲染视图
     */

    //	view($name, $hf)
    $name 默认为空,用来指定渲染页面
    $hf 默认为true,用来指定是否渲染头，尾页面
    用 $this-> 来自动加载渲染视图 view()。
    注：需要存在相对应的文件夹即可自动加载，否则报错！

    例：

    $data = $this->view('index', false);
    注：引入index.php文件并且不引入头尾页

// ---------------------------------------

// 模型使用说明
    /************************************************
     *
     * 模型数据层 (M)
     * @param  SelectAll        查询所有
     * @param  Selects          多条件查询
     * @param  SelectsAnd       必须条件查询
     * @param  Select           查询
     * @param  IdSelect         根据条件 (id) 查询
     * @param  IdDelete         根据条件 (id) 删除
     * @param  Add              新增数据
     * @param  Update           修改数据
     * @param  Delete           删除数据
     * @param  Query            自定义SQL查询，返回影响的行数
     *
     ************************************************/

// selectAll        查询所有使用方法

    // 参数说明

    /**
     * 查询所有
     * @param   table  表名
     * 全部查询
     */

    //	selectAll($table = '')

    用 $this-> 来使用 基本查找 方法 selectAll('表名'); 然后使用 return 来传递返回的值。

    例：

    return $this->selectAll('title');

// Select        查询使用方法

    // 参数说明

    /**
     * 查询
     * @param   table      表名
     * @param   id         需要查询的ID
     * @param   centest    值
     */

     //	Select($table, $id, $centest)

    用 $this-> 来使用 增加数据 方法 Select(‘表名’,‘需要查询的ID’，‘值’); 然后使用 return 来传递返回的值。

    例：

    return $this->Select('title','id','1');


// IdSelect         根据条件 (id) 查询使用方法

    // 参数说明

    /**
     * 根据条件 (id) 查询
     * @param   table      表名
     * @param   id         被查询ID
     */

     //	IdSelect($table,$id)

    用 $this-> 来使用 更新数据 方法 IdSelect(‘表名’,‘被查询ID’); 然后使用 return 来传递返回的值。

    例：

    return $this->IdSelect(‘title’,‘id’，‘1’);

// IdDelete        根据条件 (id) 删除使用方法

    // 参数说明

    /**
     * 根据条件 (id) 删除
     * @param   table      表名
     * @param   id         被删除ID
     */

     //	IdDelete($table,$id)

    用 $this-> 来使用 更新数据 方法 IdDelete(‘表名’,‘删除ID条件’); 然后使用 return 来传递返回的值。

    例：

    return $this->IdDelete(‘title’,‘1’);

// query        自定义SQL查询，返回影响的行数使用方法

    // 参数说明

    /**
     * 自定义SQL查询，返回影响的行数
     * @param   sql      SQL查询语句
     */

     // query($sql)

    用 $this-> 来使用 更新数据 方法 query(‘SQL查询语句’); 然后使用 return 来传递返回的值。

    例：

    return $this->query("insert into");

// add        新增数据使用方法

    // 参数说明

    /**
     * 新增数据
     * @param   table      表名
     * @param   data       数据(数组)
     */

     // add($table,$data)

    用 $this-> 来使用 更新数据 方法 add(‘表名’,‘数据’); 然后使用 return 来传递返回的值。

    例：
    $array = array(
            'a' => '1',
            'b' => '2'
    );
    return $this->add(‘title’,‘数据’);

// update        修改数据使用方法

    // 参数说明

    /**
     * 修改数据
     * @param   table      表名
     * @param   id         被修改ID
     * @param   data       待修改数据
     */

     // update($table,$id, $data)

    用 $this-> 来使用 更新数据 方法 update(‘表名’,‘被修改ID’,‘待修改数据’); 然后使用 return 来传递返回的值。

    例：
    return $this->update(‘title’,‘1’,‘数据’);

// delete        删除数据使用方法(暂无)

    // 参数说明

    /**
     * 删除数据
     * @param   table      表名
     * @param   centent1   待删除数据条件
     * @param   centent2   待删除数据条件内容
     */

     // delete($table, $centent1, $centent2)

    用 $this-> 来使用 更新数据 方法 delete(‘表名’, ‘待删除数据条件’, ‘待删除数据条件内容’); 然后使用 return 来传递返回的值。

    例：
    return $this->update(‘title’, ‘id’, ‘1’);

// ---------------------------------------

// 视图使用说明	
    /************************************************
     *
     * 视图数据层 (M)
     * @param  无具体参数
     *
     ************************************************/

// 输出 基本数据

    直接使用 echo 输出即可。

    例：<?php echo $data; ?>


// 引用 其它模版

    直接使用 include 加上文件名 引用即可。

    例：<?php include 'indexs.html'; ?>




/**
 * 感谢您使用HzhihePHP框架！
 *
 * 以下为附赠注释规则。
 */**
   *
   * 注释规则
   *
   * @name 名字
   * @abstract 申明变量/类/方法
   * @access 指明这个变量、类、函数/方法的存取权限
   * @author 函数作者的名字和邮箱地址
   * @category  组织packages
   * @copyright 指明版权信息
   * @const 指明常量
   * @deprecate 指明不推荐或者是废弃的信息MyEclipse编码设置
   * @example 示例
   * @exclude 指明当前的注释将不进行分析，不出现在文挡中
   * @final 指明这是一个最终的类、方法、属性，禁止派生、修改。
   * @global 指明在此函数中引用的全局变量
   * @include 指明包含的文件的信息
   * @link 定义在线连接
   * @module 定义归属的模块信息
   * @modulegroup 定义归属的模块组
   * @package 定义归属的包的信息
   * @param 定义函数或者方法的参数信息
   * @return 定义函数或者方法的返回信息
   * @see 定义需要参考的函数、变量，并加入相应的超级连接。
   * @since 指明该api函数或者方法是从哪个版本开始引入的
   * @static 指明变量、类、函数是静态的。
   * @throws 指明此函数可能抛出的错误异常,极其发生的情况
   * @todo 指明应该改进或没有实现的地方
   * @var 定义说明变量/属性。
   * @version 定义版本信息
   */
  */