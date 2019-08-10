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
 * | @package 视图基类
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
class View
{
    protected $variables = array();
    protected $_controller;
    protected $_action;
    /**
     * [__construct description]
     * @param [type] $controller [description]
     * @param [type] $action     [description]
     */
    function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
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
        $this->variables[$name] = $value;
    }
 
    // 渲染显示 修改后需到控制器变更信息
    /**
     * [view description]
     * @param  string  $value [description]
     * @param  boolean $hf    [description]
     * @param  string  $hfurl [description]
     * @return [type]         [description]
     */
    public function view($value = '', $hf = true, $hfurl = '')
    {
        extract($this->variables);
        $viewsurl = APP_PATH . APP_NAME.'/views';
        $controller = $this->_controller;
        $defaultHeader = $viewsurl.'/header.php';
        $defaultFooter = $viewsurl.'/footer.php';
        $defaultLayout = $viewsurl.'/index.php';

        if ($hfurl == '') {
            $controllerHeader = $viewsurl.'/' . $controller . '/header.php';
            $controllerFooter = $viewsurl.'/' . $controller . '/footer.php';
        }else{
            $controllerHeader = $viewsurl.'/' . $controller . '/' . strtolower($hfurl) . '/header.php';
            $controllerFooter = $viewsurl.'/' . $controller . '/' . strtolower($hfurl) . '/footer.php';
        }

        if ($value == '') {
            $controllerLayout = $viewsurl.'/' . $controller . '/' . strtolower($this->_action) . '.php';
        }else{
            $controllerLayout = $viewsurl.'/' . $controller . '/' . strtolower($value) . '.php';
        }

        // 页头文件
        if($hf == true)
        {
            if (file_exists($controllerHeader)) {
                include ($controllerHeader);
            } else if (file_exists($defaultHeader)) {
                include ($defaultHeader);
            } else {
                Notice('无法访问头部页面！');
            }
        }
        // 页内容文件
        if (file_exists($controllerLayout)) {
            include ($controllerLayout);
        } else if (file_exists($defaultLayout)) {
            include ($defaultLayout);
        } else {
            Notice('无法访问内容页面！');
        }
        
        // 页脚文件
        if($hf == true)
        {
            if (file_exists($controllerFooter)) {
                include ($controllerFooter);
            } else if (file_exists($defaultFooter)) {
                include ($defaultFooter);
            } else {
                Notice('无法访问尾部页面！');
            }
        }
    }
}