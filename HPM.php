<?php
/**
 * |********************************************************************
 * |
 * | Author: IJomu <ijomu@vip.qq.com>
 * | Copyright (c) 2015-2017, http://www.hzhihe.com. All Rights Reserved.
 * |
 * |********************************************************************
 * | Hzhihe PHPMVC - HPM 1.0
 * | php.hzhihe.com
 * | @param Object $hzhihe 总线程
 * | Update:2017-04-23
 * | 
 * | web is very nice
 * | site www.hzhihe.com
 * | @package hzhihe
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * | 核心文件
 * | (非本框架开发者请勿随意修改内容)
 * |
 * |********************************************************************
 */
class HPM
{
    /**
     * 启动框架程序
     * @return [type] [description]
     */
    public function Run()
    {
        /**
         * 自动加载
         */
        include 'Common/Include.Class.php';
    	if(WEB_SWITCH === false){
    		$array = array(
			    "Routine maintenance!（日常维护！）",
			    "Basic test!（基本检测！）"
			);
    		Maintain($array);
    	}else{
            spl_autoload_register(array($this, 'LoadClass'));
            $this->SetReporting();
            $this->RemoveMagicQuotes();
            $this->UnregisterGlobals();
            $this->Timezone_set();
            $this->WEB_HTACCESS();
            $this->WEB_SESSION();
            $this->WHURLS();
            $this->Route();
       }
    }

    /**
     * 设置中国时区
     * @return [type] [description]
     */
    public function Timezone_set()
    {
        date_default_timezone_set('PRC'); //设置中国时区
    }    

    /**
     * SESSION 开关
     */
    public function WEB_SESSION()
    {
        if(WEB_SESSION === true) {
            session_start();
        }
    }

    /**
     * 伪静态开关
     */
    public function WEB_HTACCESS()
    {
        if(WEB_HTACCESS === true)
        {
            $htaccess_file = APP_PATH.'/.htaccess';
            
            if(!file_exists($htaccess_file))
            {
                $indexphp = fopen($htaccess_file, "w") or die("Unable to open file!");

//                 fwrite($indexphp, "<IfModule mod_rewrite.c>
//     RewriteEngine On
//     RewriteCond %{REQUEST_FILENAME} !-f
//     RewriteCond %{REQUEST_FILENAME} !-d
//     RewriteRule ^(.*)$ index.php/$1 [PT,NC]
// </IfModule>
//                 ");
                fwrite($indexphp, "<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [PT,NC]
</IfModule>
                ");
            }

        }else{
            $file = APP_PATH.'/.htaccess'; 
            $result = @unlink ($file); 
            /*
            if ($result == false) {
            echo '已成功关闭！';
            } else { 
            echo '无法关闭或未开启！'; 
            } 
            */
        }
    }
    /**
     * 伪静态
     */
    public function WHURLS(){
        //  伪静态路径开关
        if(WEB_HTACCESS === true)
        {
            defined ('WHURL') or define ('WHURL','');
        }else{
            // defined ('WHURL') or define ('WHURL','/index.php');
            // ($url 为 $_GET 请求时使用)
            defined ('WHURL') or define ('WHURL','/');
        }
    }
    /**
     * 路由处理
     * @return [type] [description]
     */
    public function Route()
    {
        $controllerName = 'Index';
        $action = 'index';
        $param = array();
        // ($url 为 $_GET 请求时使用)
        // $url = isset($_GET['/']) ? $_GET['/'] : false;

        // 以防在服务器上 PATH_INFO 参数不存在
        if ( !isset($_SERVER['PATH_INFO']) && isset($_SERVER['ORIG_PATH_INFO'])) $_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];
        $pathinfo = @$_SERVER['PATH_INFO'];
        $url = isset($pathinfo) ? $pathinfo : false;

        // $pathinfo = $_SERVER['REQUEST_URI'];
		// $url = $pathinfo == '/' ? false : $pathinfo;

        if ($url) {

            // 使用“/”分割字符串，并保存在数组中
            $urlArray = explode('/', $url);
            
            // 删除空的数组元素
            $urlArray = array_filter($urlArray);

            //(输出请求状态)
            // p($urlArray);

            // 获取控制器名($url 仅为 $_GET 请求时使用)
            // if(WEB_HTACCESS === true){
            //     $urlArrays = @$urlArray[0] or die(Notice("This method cannot run!"));
            // }elseif(WEB_HTACCESS === false){
            //     $urlArrays = @$urlArray[1] or die(Notice("This method cannot run!"));
            // }
            // END
            
            $urlArrays = @$urlArray[1] or die(Notice("This method cannot run!"));
            $controllerName = ucfirst($urlArrays);

            // 修改请求地址($url 仅为 $_GET 请求时使用)
            // $urlnum = explode('?', $_SERVER['REQUEST_URI']);

            // if(count($urlnum) > 1)
            // {
            //     $urls = '';
            //     for ($i=1; $i < count($urlnum); $i++) { 
            //         $urls .= '&'.$urlnum[$i];
            //     }
            //     header('location: '.$urlnum[0].$urls);
            // }
            // END

            // 获取动作名
            array_shift($urlArray);
            $action = $urlArray ? $urlArray[0] : 'index';
            // 获取默认路由
            define('Auto_Data', $action);
            // 获取URL参数
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
        }

        // 实例化控制器
        $controller = $controllerName . 'Controller';
        $dispatch = new $controller($controllerName, $action);
		
        // 如果控制器存和动作存在，这调用并传入URL参数
        if ((int)method_exists($controller, $action)) {
            call_user_func_array(array($dispatch, $action), $param);
        } else if ((int)method_exists($controller, 'index')) {
            call_user_func_array(array($dispatch, 'index'), $param);
        } else {
            Logs('未知访问', $controller . "控制器不存在", 'HPM');
            Notice($controller . "控制器不存在");
        }
        Logs('路由访问日志', $controllerName, 'HPM');
    }

    /**
     * 调试模式开关
     */
    public function SetReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', RUNTIME_PATH. 'Logs/error.log', 'HPM');
        }
    }

    /**
     * 删除敏感字符
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }

    /**
     * 检测敏感字符并删除
     * @return [type] [description]
     */
    public function RemoveMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
            $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
            $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
            $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
        }
    }

    /**
     * 检测自定义全局变量（register globals）并移除
     * @return [type] [description]
     */
    public function UnregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
           foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    /**
     * 自动加载控制器和模型类 
     * @param  [type] $class [description]
     * @return [type]        [description]
     */
    public static function LoadClass($class)
    {
    	$_SERVER['SERVER_ADMIN'] = 'admin@hzhihe.com';
        
        $frameworks = FRAME_PATH . 'Common/' . $class . '.Class.php';
        $controllers = APP_PATH . APP_NAME .'/Controllers/' . $class . '.Class.php';
        $models = APP_PATH . APP_NAME .'/Models/' . $class . '.Class.php';

        if (file_exists($frameworks)) {
            // 加载框架核心类
            include $frameworks;
        } elseif (file_exists($controllers)) {
            // 加载应用控制器类
            include $controllers;
        } elseif (file_exists($models)) {
            //加载应用模型类
            include $models;
        } else {
            // 错误代码
            if($_COOKIE['account']){
                Logs('未知访问', '用户:['.$_COOKIE['account'].'] 访问地址:["'.$_SERVER['REQUEST_URI'].'"]', 'HPM');
            }else{
                Logs($_SERVER['REMOTE_ADDR'], '访问地址:["'.$_SERVER['REQUEST_URI'].'"]', 'HPM');
            }
            Notice('未定位到文件！');
            exit();
        }
    }
    
    /**
     * [my_dir 遍历目录及文件]
     * @param  [type] $dir [目录]
     * @return [type]      [description]
     */
    public function my_dir($dir) {
        $files = array();
        if(@$handle = opendir($dir)) { //注意这里要加一个@，不然会有warning错误提示：）
            while(($file = readdir($handle)) !== false) {
                if($file != ".." && $file != ".") { //排除根目录；
                    if(is_dir($dir."/".$file)) { //如果是子文件夹，就进行递归
                        $files[$file] = my_dir($dir."/".$file);
                    } else { //不然就将文件的名字存入数组；
                        $files[] = $file;
                    }
                }
            }
            closedir($handle);
            return $files;
        }
    }
}