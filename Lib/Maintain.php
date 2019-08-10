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
 * | @package 维护提示
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>不好依稀的啦！还在维护啦</title>
	<style type="text/css">
	body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, button, textarea, p, blockquote, th, td, div {color: #fff;margin: 0;padding: 0;font-family: Microsoft YaHei, Helvetica Neue, Helvetica, Arial, sans-serif;font-size: 14px;outline: none;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}a{color: #D4D4D4;text-decoration: none;}body{moz-user-select: -moz-none;-moz-user-select: none;-o-user-select:none;-khtml-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;background: #777; background-image: url("public/img/maintain-bj.jpg");background-position: 0% 25%;background-size:cover;background-repeat: no-repeat;}h1, h2, h3, h4, h5, h6 {font-size: 100%;}li{list-style: none;}	.content{border: 10px solid rgba(0,0,0,0.2);box-shadow: 0px 0px 5px 10px rgba(0,0,0,0.2);margin: 200px auto 0 auto;padding:50px;width: 500px;background-color: rgba(0,0,0,.35);}.metas{text-align: center;margin: 0 auto;font-size: 30px;padding-bottom:30px;}.footer_copyright{text-align: center;line-height: 28px;position: absolute;left: 0;right: 0;bottom: 50px;width: 100%;}.uls{margin-left: 50px;}.uls li{font-size: 16px;}
	</style>
</head>
<body>
	<div class="content">
		<p class="metas">黑纸盒正在维护中...<br />将给你带来全新的体验<br />敬请期待哦</p>
		<center>Hzhihe Under maintenance<br />
		It will bring you a whole new experience<br />
		Please look forward to it!<br /><br /></center>
		<ul class="uls">
			<?php if(is_array($notice)){$num = count($notice);for($i=0;$i<$num;++$i){$ids = $i+1; echo '<li>'.$ids.'、'.$notice[$i].'</li>';}}else{echo '<li>'.$notice.'</li>';} ?>

		</ul>
	</div>
	<div class="footer_copyright">
		<p>Copyright © 2016 - <script type="text/javascript">document.write(new Date().getFullYear());</script> 黑纸盒  All Rights Reserved.</p>
		<p><a target="_blank" href="javascript:alert('系统正在维护中...');" rel="nofollow" title="黑纸盒团队">黑纸盒</a>
				版权所有 - <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow" title="蜀ICP备17010122号-1">蜀ICP备17010122号-1</a></p>
	</div>
</body>
</html>
