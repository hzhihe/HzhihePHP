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
 * | @package 自定义域名(未完成)
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
function CDN($switch = 0, $host_top = '', $host_name = '', $host_domain = ''){
	if($switch == 0){
		// 默认应用目录为当前目录
		define('APP_PATH', __DIR__.'/');
	}elseif ($switch == 1) {

		$HTTP_HOST = explode('.', $_SERVER['HTTP_HOST']);
		// 自定义多域名应用目录
		define('APP_PATH', __DIR__.'/'.$HTTP_HOST[0]);

		$file = array(
			APP_PATH.APP_NAME,
			APP_PATH.APP_NAME.'/controllers',
			APP_PATH.APP_NAME.'/models',
			APP_PATH.APP_NAME.'/views',
			APP_PATH.'config',
			APP_PATH.APP_RESOURCES,
			APP_PATH.APP_RESOURCES.'/css',
			APP_PATH.APP_RESOURCES.'/js',
			APP_PATH.APP_RESOURCES.'/images'
		);

		$num = count($file);

		for($i=0; $i<$num;$i++){
			/**
			 * 判断文件或文件夹是否存在否则创建
			 */
			if(!file_exists($file[$i])){
				mkdir ($file[$i]);
				$myfile = fopen($file[$i].'/index.html', "w") or die("Unable to open file!");
				fwrite($myfile, '防目录文件，系统自动生成的文件！不建议删除');
			}else{
				echo '文件已存在或无法创建写入！';
			}
		}

		$controllers_file = $file[1].'/IndexController.Class.php';

		if(!file_exists($controllers_file)){

			$controllers = fopen($controllers_file, "w") or die("Unable to open file!");

			fwrite($controllers, '<?php

	class IndexController extends Controller
	{
		function index()
		{
			/* 业务实现例程 */
			$datas = new IndexModel();
			$data = $datas -> data();
			$this->assign("data", $data);
			$this->render();
		}
	}');
		}else{
			echo '<p>文件: " '.$controllers_file.' " </p><p style="font-size:20px;color: white;">创建失败！</p>';
		}

		/**
		 * 新建应用业务逻辑
		 * @var [type]
		 */
		$models_file = $file[2].'/IndexModel.Class.php';

		if(!file_exists($models_file)){

			$models = fopen($models_file, "w") or die("Unable to open file!");

			fwrite($models, '<?php

	class IndexModel extends Model
	{
		/* 业务逻辑层实现例程 */
		public function data()
		{
			$dats = "HzhihePHP!";
			return $dats;
		}

	}');
		}else{
			echo '<p>文件: " '.$models_file.' " </p><p style="font-size:20px;color: white;">创建失败！</p>';
		}
		/**
		 * 新建应用视图文件夹
		 */
		mkdir($file['3'].'/Index');

		/**
		 * 新建应用视图——头部
		 * @var [type]
		 */
		$viewsheader_file = $file[3].'/Index/header.php';

		if(!file_exists($viewsheader_file)){

			$viewsheader = fopen($viewsheader_file, "w") or die("Unable to open file!");

			fwrite($viewsheader, '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>基础框架已搭建完成,欢迎使用HzhihePHP！</title>
</head>
<body>
			');
		}else{
			echo '<p>文件: " '.$viewsheader_file.' " </p><p style="font-size:20px;color: white;">创建失败！</p>';
		}
		/**
		 * 新建应用视图——内容
		 * @var [type]
		 */
		$viewsindex_file = $file[3].'/Index/index.php';

		if(!file_exists($viewsindex_file)){

			$viewsindex = fopen($viewsindex_file, "w") or die("Unable to open file!");

			fwrite($viewsindex, '<h1>
	<center>
		欢迎使用<?php echo $data;?><br />
		现在开始开发你的网站工程吧！
	</center>
</h1>');
		}else{
			echo '<p>文件: " '.$viewsindex_file.' " </p><p style="font-size:20px;color: white;">创建失败！</p>';
		}

		/**
		 * 新建应用视图——尾部
		 * @var [type]
		 */
		$viewsfooter_file = $file[3].'/Index/footer.php';

		if(!file_exists($viewsfooter_file)){

			$viewsfooter = fopen($viewsfooter_file, "w") or die("Unable to open file!");

			fwrite($viewsfooter, '</body>
			</html>
			');
		}else{
			echo '<p>文件: " '.$viewsfooter_file.' " </p><p style="font-size:20px;color: white;">创建失败！</p>';
		}
		echo 'wanc';
	}
}

// p($_SERVER);
// p($_SERVER['HTTP_HOST']);
