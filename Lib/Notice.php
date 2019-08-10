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
 * | @package 错误提示
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="/public/images/favicon.png" type="image/x-icon">
    <style>body{background: linear-gradient(to right, #25c481, #25b7c4);}a{text-decoration: none;color:#FFF;}.div1{margin-top: 100px;color:#FFF;text-align: center;font-size: 100px;text-shadow:#FFF 1px 0 0,#FFF 0 1px 0,#FFF -1px 0 0,#FFF 0 -1px 0;}.div2{text-align: center;margin-top: 100px;}.div2 button{font-size: 16px;color:#FFF;border: 1px solid #FFF;margin-top: 0 auto;width: 100px;padding: 10px;background: rgba(0,0,0,0);}.div3{margin-top: 100px;color:#FFF;text-align: center;/*text-shadow:#FFF 1px 0 0,#FFF 0 1px 0,#FFF -1px 0 0,#FFF 0 -1px 0;*/}.div4{color: #FFF;text-align: center;margin-top: 100px;}</style>
</head>
<body>
    <div class="div1"><?php echo $code; ?></div>
    <div class="div4"><?php echo $notice; ?></div>
    <?php echo $button == true ? '<div class="div2"><a href="/"><button>返回主页</button></a></div>' : ''; ?>
    <div class="div3">* Copyright © 2017 <a href="http://www.hzhihe.com">黑纸盒</a> All Rights Reserved.</div>
</body>
</html>
