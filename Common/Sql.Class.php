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
 * | @package 数据库操作
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
class Sql
{
  protected $_dbHandle;
  protected $_result;
 
  // 连接数据库
  /**
   * [connect description]
   * @param  [type] $host    [description]
   * @param  [type] $user    [description]
   * @param  [type] $pass    [description]
   * @param  [type] $dbname  [description]
   * @param  [type] $charset [description]
   * @return [type]          [description]
   */
  public function connect($host, $user, $pass, $dbname, $charset)
  {
    try {
      $dsn = sprintf("mysql:host=%s;dbname=%s;charset=".$charset, $host, $dbname);
      $this->_dbHandle = new PDO($dsn, $user, $pass, array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
      Logs('警报', mb_convert_encoding($e->getMessage(),'UTF-8','GBK'), 'PDO');
      exit(Notice(mb_convert_encoding($e->getMessage(),'UTF-8','GBK'), '警报', '警报', false));
    }
  }
  // 查询
  /**
   * [Select description]
   * @param [type] $table   [description]
   * @param [type] $id      [description]
   * @param [type] $centest [description]
   */
  public function Select($table, $id, $centest)
  {
    $sql = sprintf("select * from `%s` where `%s` = '%s'", strtolower($table), $id, $centest);
    $sth = $this->_dbHandle->prepare($sql);
    $sth->execute();
     
    return $sth->fetch();
  }

  // 查询所有
  /**
   * [SelectAll description]
   * @param string $table [description]
   */
  public function SelectAll($table = '')
  {
    $sql = sprintf("select * from `%s`", strtolower($table));
    $sth = $this->_dbHandle->prepare($sql);
    $sth->execute();
 
    return $sth->fetchAll();
  }

  // 多条件查询
  /**
   * [Selects description]
   * @param string $table      [description]
   * @param [type] $id1        [description]
   * @param [type] $centest1   [description]
   * @param [type] $data_array [description]
   */
  public function Selects($table = '', $id1, $centest1, $data_array)
  {
    $sql = sprintf("select * from `%s` where `%s` = '%s' %s", strtolower($table), $id1, $centest1, $this->FormatSelect($data_array));
    $sth = $this->_dbHandle->prepare($sql);
    $sth->execute();
 
    return $sth->fetchAll();
  }
  // 必须条件查询
  /**
   * [SelectsAnd description]
   * @param string $table      [description]
   * @param [type] $id1        [description]
   * @param [type] $centest1   [description]
   * @param [type] $data_array [description]
   */
  public function SelectsAnd($table = '', $id1, $centest1, $data_array)
  {
    $sql = sprintf("select * from `%s` where `%s` = '%s' %s", strtolower($table), $id1, $centest1, $this->FormatSelectAnd($data_array));
    $sth = $this->_dbHandle->prepare($sql);
    $sth->execute();
 
    return $sth->fetchAll();
  }

  // 根据条件 (id) 查询
  /**
   * [IdSelect description]
   * @param [type] $table [description]
   * @param [type] $id    [description]
   */
  public function IdSelect($table,$id)
  {
    $sql = sprintf("select * from `%s` where `id` = '%s'", strtolower($table), $id);
    $sth = $this->_dbHandle->prepare($sql);
    $sth->execute();
    
    return $sth->fetch();
  }
 
  // 根据条件 (id) 删除
  /**
   * [IdDelete description]
   * @param [type] $table [description]
   * @param [type] $id    [description]
   */
  public function IdDelete($table,$id)
  {
    $sql = sprintf("delete from `%s` where `id` = '%s'", strtolower($table), $id);
    $sth = $this->_dbHandle->prepare($sql);
    $sth->execute();
 
    return $sth->rowCount();
  }
 
  // 自定义SQL查询，返回影响的行数
  /**
   * [Query description]
   * @param [type] $sql [description]
   */
  public function Query($sql)
  {
    $sth = $this->_dbHandle->prepare($sql);
    $sth->execute();
 
    return $sth->rowCount();
  }
 
  // 新增数据
  /**
   * [Add description]
   * @param [type] $table [description]
   * @param [type] $data  [description]
   */
  public function Add($table,$data)
  {
    
    $sql = sprintf("insert into `%s` %s", strtolower($table), $this->FormatInsert($data));
 
    return $this->query($sql);
  }
  // 新增数据
  /**
   * [Adds description]
   * @param [type] $table [description]
   * @param [type] $data  [description]
   */
  public function Adds($table,$data)
  {
    
    $sql = sprintf("insert into `%s` %s", strtolower($table), $this->FormatInserts($data));
 
    return $this->query($sql);
  }
 
  // 修改数据
  /**
   * [Update description]
   * @param [type] $table [description]
   * @param [type] $data  [description]
   * @param [type] $data1 [description]
   * @param [type] $data2 [description]
   */
  public function Update($table,$data, $data1, $data2)
  {
    $sql = sprintf("update `%s` set %s where `%s` = '%s'", strtolower($table), $this->FormatUpdate($data), $data1, $data2);
 
    return $this->query($sql);
  }

  // 删除数据
  /**
   * [Delete description]
   * @param [type] $table    [description]
   * @param [type] $centent1 [description]
   * @param [type] $centent2 [description]
   */
  public function Delete($table, $centent1, $centent2)
  {
    $sql = sprintf("delete from `%s` where `%s` = '%s'", strtolower($table), $centent1, $centent2);

    return $this->query($sql);
  }





  // 将数组转换成查询格式的sql语句
  private function FormatSelect($data)
  {
    $fields = array();
    foreach ($data as $key => $value) {
      $fields[] = sprintf(" or `%s` = '%s'", $key, $value);
    }
 
    return implode('', $fields);
  }
  // 将数组转换成查询格式的必须sql语句
  private function FormatSelectAnd($data)
  {
    $fields = array();
    foreach ($data as $key => $value) {
      $fields[] = sprintf(" and `%s` = '%s'", $key, $value);
    }
 
    return implode('', $fields);
  }
 
  // 将数组转换成插入格式的sql语句
  private function FormatInsert($data)
  {
    $fields = array();
    $values = array();
    foreach ($data as $key => $value) {
      $fields[] = sprintf("`%s`", $key);
      $values[] = sprintf("'%s'", $value);
    }
 
    $field = implode(',', $fields);
    $value = implode(',', $values);
    return sprintf("(%s) values (%s)", $field, $value);
  }

  // 将数组转换成插入格式的sql语句
  private function FormatInserts($data)
  {
    $fields = array();
    $values = array();
    foreach ($data as $key => $value) {
      $fields[] = sprintf("`%s`", $key);
      $values[] = sprintf("'%s'", $value);
    }
 
    $field = implode(',', $fields);
    $value = implode(',', $values);
    return sprintf("(%s) values (%s)", $field, $value);
  }
 
  // 将数组转换成更新格式的sql语句
  private function FormatUpdate($data)
  {
    $fields = array();
    foreach ($data as $key => $value) {
      $fields[] = sprintf("`%s` = '%s'", $key, $value);
    }
 
    return implode(',', $fields);
  }
}