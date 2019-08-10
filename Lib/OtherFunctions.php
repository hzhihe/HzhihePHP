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
 * | @package 功能集合
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 * | 功能介绍：
 * | 	实时数据
 * | 	直接跳转
 * | 	几秒后跳转
 * | 	异步同步
 * | 	正则表达式
 * | 	随机数
 * | 	用户名邮箱手机账号中间字符串以*隐藏
 * | 	自定义信息框
 * | 	自定义信息框
 * | 	信息输出
 * | 	维护升级
 * | 	IP获取
 * | 	伪造IP
 * | 	将XML转为array
 * | 	获取GET或POST过来的参数
 * | 	以cUrl访问Http
 * | 	检查是否是身份证号
 * | 	根据身份证号，自动返回性别
 * | 	根据身份证号，自动返回对应的生肖
 * | 	根据身份证号，自动获取对应的星座函数
 * |********************************************************************
 */
/**
* 
*/
	/**
	 * 实时数据
	 * @param  [type] $centent 数据内容
	 * @return [type]          返回数据
	 */
	function push($centent){
		header('Content-Type:text/event-stream');//通知浏览器开启事件推送功能
	    header('Cache-Control:no-cache');//告诉浏览器当前页面不进行缓存
	    return "data:{$centent}\n\n";
	    ob_flush();
	    flush();
	}

	/**
	 * 直接跳转
     * @param $url 地址
     */
    function urlgo($url){
        header("Location:".$url);
    }

    /**
     * 几秒后跳转
     * @param $url 地址
     * @param int $sec 间隔默认1秒
     */
    function redirectSec($url,$sec=1){
        header("Refresh:{$sec};url:{$url}");
    }

	/**
	 * 异步同步
	 * @param  [type] $url   [description]
	 * @param  [type] $id    [description]
	 * @param  [type] $error [description]
	 * @return [type]        [description]
	 */
	function push_js($url, $id, $error){
    	return '<script type="text/javascript">
	if(typeof(EventSource)!=="undefined"){
		var es = new EventSource("'.$url.'");
		es.addEventListener("message", function(e){
			document.getElementById("'.$id.'").innerHTML = e.data;
		},false);
	}
</script>';
    }
	
	/**
	 * 正则表达式
	 * @param [type] $type 类型
	 * @param [type] $data 资源
	 */
	function Expression($types,$data){

		$types = strtoupper($types);

		$data = strtoupper($data);

		if($types = 'mail'){
			$preg = '/^(\w{1,25})@(\w{1,16})(\.(\w{1,4})){1,3}$/';	// 邮箱地址正则表达式
		}

		if(preg_match($preg, $data)){
			return true;
		}else{
			return false;
		}
	}

    /**
     * 随机数
     * @param  [type] $da  随机类型
     * @param  [type] A    数字
     * @param  [type] B    大写字母
     * @param  [type] C    小写字母
     * @param  [type] D    数字大写字母
     * @param  [type] E    数字小写字母
     * @param  [type] F    数字大小写字母
     * 
     * @param  [type] $num 随机长度
     * @return [type]      [description]
     */
    function rands($da,$num){
        $da = strtoupper($da);
        $data = '';
        $A = '0123456789';                  // 数字  		$data = $data.rand(0, 9);
        $B = 'ABCDEFGHIGKLMNOPQRSTUVWXYZ';  // 大写字母     $data = $data.chr(rand(65, 90));
        $C = 'abcdefghijklmnopqrstuvwxyz';  // 小写字母     $data = $data.chr(rand(97, 122));
        $D = $A.$B;                         // 数字大写字母
        $E = $A.$C;                         // 数字小写字母
        $F = $A.$B.$C;                      // 数字大小写字母
        for($i = 0; $i < $num;$i++){
            if($da === 'A'){      	// 数字
                $data = $data.$A{rand(0, strlen($A)-1)};
            }elseif($da === 'B'){ 	// 大写字母
                $data = $data.$B{rand(0, strlen($B)-1)};
            }elseif($da === 'C'){ 	//小写字母
                $data = $data.$C{rand(0, strlen($C)-1)};
            }elseif($da === 'D'){ 	// 大小写字母
                $data = $data.$D{rand(0, strlen($D)-1)};
            }elseif($da === 'E'){ 	// 大小写字母
                $data = $data.$E{rand(0, strlen($E)-1)};
            }elseif($da === 'F'){ 	// 大小写字母
                $data = $data.$F{rand(0, strlen($F)-1)};
            }
        }
        return $data;
    }
    
    /**
     * 用户名、邮箱、手机账号中间字符串以*隐藏
     * @param  [type] $str [description]
     * @return [type]      [description]
     */
    function hideStar($str) {
    if (strpos($str, '@')) { 
        $email_array = explode("@", $str); 
        $prevfix = (strlen($email_array[0]) < 4) ? "" : substr($str, 0, 3); //邮箱前缀 
        $count = 0; 
        $str = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $str, -1, $count); 
        $rs = $prevfix . $str; 
    } else { 
        $pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i';
        $num = strlen($str);
        if (preg_match($pattern, $str)) { 
            $rs = preg_replace($pattern, '$1****$2', $str); // substr_replace($name,'****',3,4); 
        } else {
            $rs = substr($str, 0, $num - 5) . "***" . substr($str, -2);
        }
    } 
    return $rs; 
	}

	/**
	 * 自定义信息框
	 * @param  [type] $var [description]
	 * @return [type]      [description]
	 */
	function p($var = ''){
	    if(is_bool($var)){
	        var_dump($var);
	    }else if(is_null($var)){
	        var_dump(NULL);
	    }else{
	        echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre>";
	    }
	}

	/**
	 * 信息输出
	 * @param string $notices [description]
	 */
	function Notice($notice='', $code = "404", $title = "哎哟，这是一个不知道的页面呀!", $button = true)
	{
	    include _LIB_.'/Notice.php';
	    exit();
	}
	    
	/**
	 * 维护升级
	 * @param  string $notices [description]
	 * @return [type]          [description]
	 */
	function maintain($notices = '')
	{
	    $notice = $notices;
	    include _LIB_.'/Maintain.php';
	    exit();
	}
	/**
	 * IP获取
	 * @return [type] [description]
	 */

	function getIp()
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			$cip = $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$cip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}elseif(!empty($_SERVER['REMOTE_ADDR'])){
			$cip = $_SERVER['REMOTE_ADDR'];
		}else{
			$cip = $this->get_rand_ip();
		}
		return $cip;
	}

	/*function GetIp(){
	    $onlineip=''; 
	    if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){ 
	        $onlineip=getenv('HTTP_CLIENT_IP'); 
	    } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){ 
	        $onlineip=getenv('HTTP_X_FORWARDED_FOR'); 
	    } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){ 
	        $onlineip=getenv('REMOTE_ADDR'); 
	    } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){ 
	        $onlineip=$_SERVER['REMOTE_ADDR']; 
	    } 
	    return $onlineip; 
	}*/

	/**
	 * 伪造IP
	 * @return [type] [description]
	 */
	function get_rand_ip()
	{
		$arr_1 = array("218","218","66","66","218","218","60","60","202","204","66","66","66","59","61","60","222","221","66","59","60","60","66","218","218","62","63","64","66","66","122","211");
		$randarr= mt_rand(0,count($arr_1));
		$ip1id = $arr_1[$randarr];
		$ip2id=  round(rand(600000,  2550000)  /  10000);
		$ip3id=  round(rand(600000,  2550000)  /  10000);
		$ip4id=  round(rand(600000,  2550000)  /  10000);
		return  $ip1id . "." . $ip2id . "." . $ip3id . "." . $ip4id;
	}

	/**
	 * 将XML转为array
	 * @param  [type] $xml [description]
	 * @return [type]      [description]
	 */
	function xmlToArray($xml)
	{
		//禁止引用外部xml实体
		libxml_disable_entity_loader(true);
		$values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		return $values;
	}


	/**
	 * 获取GET或POST过来的参数
	 * @param $key 键值
	 * @param $default 默认值
	 * @return 获取到的内容（没有则为默认值）
	 */
	function getParam($key,$default='')
	{
	    return trim($key && is_string($key) ? (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default)) : $default);
	}
	/**
	 * [http_curl 以cUrl访问Http]
	 * @param  [type] $url  [请求的url]
	 * @param  string $type [请求类型]
	 * @param  string $res  [返回数据类型]
	 * @param  string $arr  [post请求参数]
	 * @return [type]       [description]
	 */
    function http_curl($url,$type='get',$res='json',$arr=''){

        $ch=curl_init();
        /*$url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxf71d53c65df41aab&secret=e31e44c35067fb75759f53eed1cb1b26';  */
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if($type=='post'){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
        }
        $output = curl_exec($ch);
        curl_close($ch);
        if($res=='json'){
            return json_decode($output,true);
        }
    }
    
	/**
	 * [isIdCard 检查是否是身份证号]
	 * @param  [type]  $number [description]
	 * @return boolean         [description]
	 */
	function isIdCard($number) {
	    // 转化为大写，如出现 x
	    $number = strtoupper($number);
	    //加权因子
	    $wi = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
	    //校验码串
	    $ai = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
	    //按顺序循环处理前 17 位
	    $sigma = 0;
	    for($i = 0;$i < 17;$i++){
	        //提取前 17 位的其中一位，并将变量类型转为实数
	        $b = (int) $number{$i};      //提取相应的加权因子
	        $w = $wi[$i];     //把从身份证号码中提取的一位数字和加权因子相乘，并累加
	        $sigma += $b * $w;
	    }
	    //计算序号
	    $snumber = $sigma % 11;
	    //按照序号从校验码串中提取相应的字符。
	    $check_number = $ai[$snumber];
	    if($number{17} == $check_number){ 
	        return true;
	    }else{
	        return false;
	    }
	}
    /**
     * [get_xingzuo 根据身份证号，自动获取对应的星座函数]
     * @param  [type] $cid [description]
     * @return [type]      [description]
     */
	function get_xingzuo($cid) { 
	    if (!isIdCard($cid)) return '';
	    $bir = substr($cid,10,4);
	    $month = (int)substr($bir,0,2);
	    $day = (int)substr($bir,2);
	    $strValue = '';
	    if(($month == 1 && $day <= 21) || ($month == 2 && $day <= 19)) {
	    	$strValue = "水瓶座";
	    }else if(($month == 2 && $day > 20) || ($month == 3 && $day <= 20)) {
	    	$strValue = "双鱼座";
	    }else if (($month == 3 && $day > 20) || ($month == 4 && $day <= 20)) {
	    	$strValue = "白羊座";
	    }else if (($month == 4 && $day > 20) || ($month == 5 && $day <= 21)) {
	     $strValue = "金牛座";
	 	}else if (($month == 5 && $day > 21) || ($month == 6 && $day <= 21)) {
	     $strValue = "双子座";
	 	}else if (($month == 6 && $day > 21) || ($month == 7 && $day <= 22)) {
	     $strValue = "巨蟹座";
	 	}else if (($month == 7 && $day > 22) || ($month == 8 && $day <= 23)) {
	     $strValue = "狮子座";
	 	}else if (($month == 8 && $day > 23) || ($month == 9 && $day <= 23)) {
	     $strValue = "处女座";
	 	}else if (($month == 9 && $day > 23) || ($month == 10 && $day <= 23)) {
	     $strValue = "天秤座";
	 	}else if (($month == 10 && $day > 23) || ($month == 11 && $day <= 22)) {
	     $strValue = "天蝎座";
	 	}else if (($month == 11 && $day > 22) || ($month == 12 && $day <= 21)) {
	     $strValue = "射手座";
	 	}else if (($month == 12 && $day > 21) || ($month == 1 && $day <= 20)) {
	        $strValue = "魔羯座";
	    }  
	    return $strValue;
	}
	/**
	 * [get_shengxiao 根据身份证号，自动返回对应的生肖]
	 * @param  [type] $cid [description]
	 * @return [type]      [description]
	 */
	function get_shengxiao($cid) {
	
	    if(!isIdCard($cid)) return '';
	    $start = 1901;
	    $end = $end = (int)substr($cid,6,4);
	    $x = ($start - $end) % 12;
	    $value = "";
	    if($x == 1 || $x == -11){
	        $value = "鼠";
	    }
	    if($x == 0) {
	        $value = "牛";
	    } 
	    if($x == 11 || $x == -1){
	        $value = "虎";
	    }
	    if($x == 10 || $x == -2){
	        $value = "兔";
	    }
	    if($x == 9 || $x == -3){
	        $value = "龙";
	    }
	    if($x == 8 || $x == -4){
	        $value = "蛇";
	    }
	    if($x == 7 || $x == -5){
	        $value = "马";
	    }
	    if($x == 6 || $x == -6){
	        $value = "羊";
	    }
	    if($x == 5 || $x == -7){
	        $value = "猴";
	    }
	    if($x == 4 || $x == -8){
	        $value = "鸡";
	    }
	    if($x == 3 || $x == -9){
	        $value = "狗";
	    }
	    if($x == 2 || $x == -10){
	        $value = "猪";
	    }
	    return $value;
	}
	/**
	 * [get_xingbie 根据身份证号，自动返回性别]
	 * @param  [type] $cid [description]
	 * @return [type]      [description]
	 */
	function get_xingbie($cid) {
	    if(!isIdCard($cid)) return '';
	    $sexint = (int)substr($cid,16,1);
	    return $sexint % 2 === 0 ? '女' : '男';
	}