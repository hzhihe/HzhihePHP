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
 * | @package 黑纸盒邮箱
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
header("content-type:text/html;charset=utf-8");
ini_set("magic_quotes_runtime",0);
/*
 * Host 		  SMTP地址	 	如：smtp.***.com
 * Username 	  帐号    	  	如：admin@***.com
 * Password 	  密码		  	如：123456
 * FromName		  发件人昵称	如：***科技
 * User 		  收件人		如：*******@qq.com
 * Title 		  邮件主题		如：找回密码
 * Centent 		  邮件内容		如：您的验证码是 123456
 * AddAttachment  附件地址		如："F:/Filename.png"
 */
function HMail($User = '',  $Title = '', $Centent = '', $FromName = '', $AddAttachment = ''){

$arr = array(
    'code'=>'400',
    'message'=>'Delete has Error',
    'result' => false
);

include 'PhpMailer.php';
if($FromName === ''){
	$FromName = HMAIL_FromName;
}
try {
	$mail = new PHPMailer(true); 
	$mail->IsSMTP();
	$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
	$mail->SMTPAuth   = true;                  //开启认证
	$mail->Port       = 25;                    
	$mail->Host       = HMAIL_Host;
	$mail->Username   = HMAIL_Username;
	$mail->Password   = HMAIL_Password;
	//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
	$mail->AddReplyTo(HMAIL_Username,$FromName);//回复地址
	$mail->From       = HMAIL_Username;
	$mail->FromName   = $FromName;
	$to  = $User;
	$mail->AddAddress($to);
	$mail->Subject    = $Title;
	$mail->Body = $Centent;

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
	$mail->WordWrap   = 80; // 设置每行字符串的长度
	if(!empty($AddAttachment) && $AddAttachment !== 'null'){
		$mail->AddAttachment($AddAttachment);  //可以添加附件
	}
	$mail->IsHTML(true); 
	$mail->Send();

	// echo '邮件已发送';

	$arr['code'] = '200';
    $arr['message'] = 'The mail has been sent!';
    $arr['result'] = true;
    return json_encode($arr);

} catch (phpmailerException $e) {

	// echo "邮件发送失败：".$e->errorMessage();
	
	$arr['code'] = '400';
    $arr['message'] = 'Mail failed!';//.$e->errorMessage();
    $arr['result'] = false;
    return json_encode($arr);
	
}
}

function hmail_content($title, $centent, $code, $footer = ''){
	return <<<"HMAIL_CONTENT"
	<style>a{color: #66c0f4;    text-decoration: none;}</style><table style="width: 538px; background-color: #393836;" align="center" cellspacing="0" cellpadding="0">
	<tbody><tr>
		<td style="padding-left:20px;  height: 65px; background: #171a21; color:#dbdbdb; font-size:22px;   font-weight:bold;border-bottom: 1px solid #4d4b48;"><p>黑纸盒科技</p></td>
	</tr>
	<tr>
		<td bgcolor="#17212e">
			<table width="470" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left: 5px; padding-right: 5px; padding-bottom: 10px;">
				<tbody><tr bgcolor="#17212e">
					<td style="padding-top: 32px;">
					<span style="padding-top: 16px; padding-bottom: 16px; font-size: 24px; color: #66c0f4; font-family: Arial, Helvetica, sans-serif; font-weight: bold;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
						<a>{$title}</a></font></font></span><br>
					</td>
				</tr>
				<tr>
					<td style="padding-top: 12px;">
					<span style="font-size: 17px; color: #c6d4df; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">
						<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{$centent}</font></font></p>
					</span>
					</td>
				</tr>
				<tr>
					<td>
						<div>
							<span style="font-size: 24px; color: #66c0f4; font-family: Arial, Helvetica, sans-serif; font-weight: bold;"><font style="vertical-align: inherit;">{$code}<font style="vertical-align: inherit;"></font></font></span>
						</div>
					</td>
				</tr>
				<tr>
					<td style="font-size: 12px; color: #9e9e9e; padding-top: 16px; padding-bottom: 16px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{$footer}</font></font><br><br>
                    </td>
				</tr>
				<tr>
					<td style="font-size: 12px; color: #6d7880; padding-top: 16px; padding-bottom: 60px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">黑纸盒科技</font></font><br><a style="color: #8f98a0;" href="http://www.hzhihe.com/" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">http://www.hzhihe.com/</font></font></a><br>
                    </td>
				</tr>
			</tbody></table>
		</td>
	</tr>

 <tr><td bgcolor="#000000">
     	<table width="460" height="55" border="0" align="center" cellpadding="0" cellspacing="0">
       	 <tbody><tr valign="top">
          <td width="110">
            <a href="http://www.hzhihe.com/" target="_blank" style=" color: #8B8B8B; font-size: 10px; font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; text-transform: uppercase;  " font-size:="font-size:" px="px" color:="color:" b8b8b="b8b8b" font-family:="font-family:" trebuchet="trebuchet" ms="ms" text-transform:="text-transform:" uppercase="uppercase">
			<img src="http://www.hzhihe.com/logo.gif" width="92" height="26" hspace="0" vspace="0" border="0" align="top"><span></span></a></td>
		  <td width="350" valign="top">
		   <span style="color: #999999; font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">©黑纸盒科技。</font><font style="vertical-align: inherit;">版权所有。</font><font style="vertical-align: inherit;">所有商标均为所有者的所有。</font></font></span>
		  </td>
       	 </tr>
        </tbody></table>
	</td>
  </tr><tr></tr>
</tbody>
</table>
HMAIL_CONTENT;
}