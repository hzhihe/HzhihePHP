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
 * | @package 框架入口文件
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
if(!file_exists('config/install_ok.php'))
{
	include '../HzhihePHP/install.php';	// 框架安装程序
}else{
	include 'Common/Catalog.Class.php'; 
	include 'HPM.php';					// 包含核心框架类
	$fast = new HPM;					// 实例化核心类
	$fast->Run();
}