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
 * | @package 自动加载
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
	
// 设置编码字符集
header('Content-type:text/html;charset=utf-8');

// 伪静态文件开关
defined ('WEB_HTACCESS') or define ('WEB_HTACCESS',false);

// 初始化常量
defined ('WEB_SWITCH') or define ('WEB_SWITCH',true);

defined ('WEB_SESSION') or define ('WEB_SESSION',true);

defined ('APP_DEBUG') or define('APP_DEBUG', false);

// 路径设置

// 当前目录向上
defined ('FRAME_PATH') or define('FRAME_PATH', __DIR__.'/../'); 

defined ('HzhihePHP') or define('HzhihePHP','HzhihePHP');

defined ('APP_PATH') or define('APP_PATH', $_SERVER['DOCUMENT_ROOT'].'/');

defined ('APP_CONFIG') or define('APP_CONFIG', APP_PATH.'Config');

defined ('APP_LOG') or define('APP_LOG', APP_PATH.'/Logs/');

// 应用名称
defined ('APP_NAME') or define('APP_NAME', 'Application');

defined ('APP_RESOURCES') or define('APP_RESOURCES', 'Public');
// 网站根URL
defined ('APP_URL') or define ('APP_URL', 'http://'.$_SERVER['HTTP_HOST']);

// 资源路径
defined ('_LIB_') or define ('_LIB_',HzhihePHP.'/Lib');

defined ('_PUBLIC_') or define ('_PUBLIC_',APP_URL.'/Public');

defined ('_IMG_') or define ('_IMG_',_PUBLIC_.'/Images');

defined ('_CSS_') or define ('_CSS_',_PUBLIC_.'/Css');

defined ('_JS_') or define ('_JS_',_PUBLIC_.'/Js');

defined ('_DOWN_') or define ('_DOWN_',_PUBLIC_.'/Down');