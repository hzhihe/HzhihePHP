<?php
	// 日志资源设置
	$logfile = "Logs/AttackProtectionLog";
	//查询禁止IP
	$ip = $_SERVER['REMOTE_ADDR'];
	$fileht = ".AttackProtection";
	if(!file_exists($fileht))file_put_contents($fileht,"");  
	$filehtarr = @file($fileht);  
	if(in_array($ip."\r\n",$filehtarr))die(Notice("由于某种原因，您的IP地址被禁止，如果您有任何疑问，请发送电子邮件至admin@hzhihe.com！"."<br>"."Your IP address are forbided by some reason, IF you have any question Pls emill to admin@hzhihe.com!", "Warning 警告", "Warning 警告", false));
	 
	//加入禁止IP  
	$time = time();  
	$fileforbid=$logfile."/forbidchk.dat";  
	if(file_exists($fileforbid))
	{
		if($time-filemtime($fileforbid)>60){
			unlink($fileforbid);  
		}else{  
			$fileforbidarr=@file($fileforbid);  
			if($ip==substr($fileforbidarr[0],0,strlen($ip)))  
			{  
				if($time-substr($fileforbidarr[1],0,strlen($time))>600){
					unlink($fileforbid);  
				}elseif($fileforbidarr[2]>600){
					file_put_contents($fileht,$ip."\r\n",FILE_APPEND);
					unlink($fileforbid);
				}else{
					$fileforbidarr[2]++;
					file_put_contents($fileforbid,$fileforbidarr);
				}  
			}  
		}  
	}
	//防刷新  
	$str = "";  
	$file = $logfile."/ipdate.dat";  
	if(!file_exists($logfile)&&!is_dir($logfile))mkdir($logfile,0777); 
	if(!file_exists($file))file_put_contents($file,"");  
	$allowTime = 120;//防刷新时间  
	$allowNum = 999999999;//防刷新次数
	$uri = $_SERVER['SERVER_NAME'];
	// p($_SERVER);
	$checkip = md5($ip);
	$checkuri = md5($uri);  
	$yesno = true;  
	$ipdate = @file($file);  
	foreach($ipdate as $k=>$v)  
	{
		$iptem=substr($v,0,32);  
		$uritem=substr($v,32,32);  
		$timetem=substr($v,64,10);  
		$numtem=substr($v,74);  
		if($time-$timetem<$allowTime){  
			if($iptem!=$checkip)
			{
				$str.=$v;
			}else{  
			$yesno=false;  
			if($uritem!=$checkuri)
			{
				$str.=$iptem.$checkuri.$time."1\r\n";
			}elseif($numtem<$allowNum)
			{
				$str.=$iptem.$uritem.$timetem.($numtem+1)."\r\n";
			}else{  
				if(!file_exists($fileforbid)){$addforbidarr=array($ip."\r\n",time()."\r\n",1);file_put_contents($fileforbid,$addforbidarr);}  
				file_put_contents($logfile."/forbided_ip.log",'['.@date("Y-m-d H:i:s",time()).'] ['.$ip."] [".$uri."] [".($_SERVER['REQUEST_URI'] == '/' ? '/' : $_SERVER['REQUEST_URI'])."]\r\n",FILE_APPEND);
				$timepass=$timetem+$allowTime-$time;  
				die(Notice("抱歉，您经常刷新被禁止，请等待".$timepass."秒后继续！"."<br>"."Sorry,you are forbided by refreshing frequently too much, Pls wait for ".$timepass." seconds to continue!", "Warning 警告", "Warning 警告"));
				}  
			}  
		}  
	}  
	if($yesno) $str.=$checkip.$checkuri.$time."1\r\n";  
	file_put_contents($file,$str);