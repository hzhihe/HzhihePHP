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
 * | @package 控制器基类
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
class Controller
{
    protected $_controller;
    protected $_action;
    protected $_view;
    
 
    // 构造函数，初始化属性，并实例化对应模型
    /**
     * [__construct description]
     * @param [type] $controller [description]
     * @param [type] $action     [description]
     */
    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
    }

    // 分配变量
    /**
     * [assign description]
     * @param  [type] $name  [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }

    // 渲染视图
    /**
     * [view description]
     * @param  string  $value [description]
     * @param  boolean $hf    [description]
     * @param  string  $hfurl [description]
     * @return [type]         [description]
     */
    public function view($value = '', $hf = true, $hfurl = '')
    {
        $this->_view->view($value, $hf, $hfurl);
    }
	/**
     * [autoindex description]
     * @param  [type] $function [description]
     * @return [type]           [description]
     */
	public function autoindex($function)
	{
		if(Auto_Data == 'index'){
            return false;
        }
		$this -> $function(Auto_Data);
	}
    /**
     * [geturl description]
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public function geturl($url)
    {
        return file_get_contents($url);
    }
    /**
     * [jsonurl description]
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public function jsonurl($url)
    {
        return json_decode(file_get_contents($url), true);
    }
    /**
     * [location description]
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public function location($url)
    {
        header('location: '.$url);
    }
    /**
     * [autogeturl description]
     * @param  [type]  $array [description]
     * @param  boolean $type  [description]
     * @return [type]         [description]
     */
    public function autogeturl($array, $type = false)
    {
        $urldata = '';
        foreach ($array as $key => $value) {
            $urldata .= '&'.$key.'='.$value;
        }
        if ($type == true) {
            $urldata = '?'.$urldata;
            $urldata = str_replace("?&","?",$urldata);
        }
        
        return $urldata;
    }

    /**
     * combineURL
     * 拼接url
     * @param string $baseURL   基于的url
     * @param array  $keysArr   参数列表数组
     * @return string           返回拼接的url
     */
    public function combineURL($baseURL,$keysArr){
        $combined = $baseURL."?";
        $valueArr = array();

        foreach($keysArr as $key => $val){
            $valueArr[] = "$key=$val";
        }

        $keyStr = implode("&",$valueArr);
        $combined .= ($keyStr);
        
        return $combined;
    }
}