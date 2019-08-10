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
 * | @package 自动加载项目
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */

include APP_CONFIG.'/config.php';			// 配置信息
$Libdir = [
'VerifyCode',			// 验证码
'OtherFunctions',		// 其它自定义功能
'Key',                 	// 自定义密匙
'CheckRepeatSubmit',   	// php页面防重复提交方法
'H_Mailer',   		 	// php邮件 
'Alert',   		 		// 自定义提示框
'Logs',   		 		// 日志
'Custom_Domain_Name',   // 自定义域名
'phpqrcode',    		// 二维码生成
// 'AttackProtection',    	// 攻击防护：DDOS
];
// include _LIB_.'/code';   	// 自定义域名

foreach ($Libdir as $key => $value) {
    if(is_array($value) == false)
    {
        include _LIB_.'/'.$Libdir[$key].'.php';
    }
}

