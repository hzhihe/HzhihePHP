<?php
/**
 * |********************************************************************
 * |
 * | Author: IJomu <ijomu@vip.qq.com>
 * | Copyright (c) 2015-2017, http://www.hzhihe.com. All Rights Reserved.
 * |
 * |********************************************************************
 * |
 * | web is very nice
 * | site www.hzhihe.com
 * | @package 模型基类
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
class Model extends Sql
{
  protected $_model;
  protected $_table;
  /**
   * [__construct description]
   */
  function __construct()
  {
    // 连接数据库
    $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_CHARSET);
     
    // 获取模型名称
    $this->_model = get_class($this);
    $this->_model = rtrim($this->_model, 'Model');
     
    // 数据库表名与类名一致
    //$this->_table = strtolower($this->_model);
  }
  /**
   * [__destruct description]
   */
  function __destruct()
  {
  }
}

/*

class Model extends Sql
{
    protected $_model;
    
    protected $_table;

    public function __construct()
    {
        // 连接数据库
        $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_CHARSET);
        
        // 获取模型类名
        $this->_model = get_class($this);

        // 删除类名最后的 Model 字符
        $this->_model = substr($this->_model, 0, -5);
        
        // 数据库表名与类名一致
        $this->_table = strtolower($this->_model);
    }
}
*/