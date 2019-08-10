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
 * | @package 高级加密
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
/**
 * 加密方式一
 */

class key_1{

    // 加密
    function encrypt($data, $key = '') { 
        $prep_code = serialize($data); 
        $block = mcrypt_get_block_size('des', 'ecb'); 
        if (($pad = $block - (strlen($prep_code) % $block)) < $block) { 
            $prep_code .= str_repeat(chr($pad), $pad); 
        } 
        $encrypt = mcrypt_encrypt(MCRYPT_DES, $key, $prep_code, MCRYPT_MODE_ECB); 
        return base64_encode($encrypt); 
    }

    // 解密
    function decrypt($str, $key = '') {
        $str = base64_decode($str); 
        $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB); 
        $block = mcrypt_get_block_size('des', 'ecb'); 
        $pad = ord($str[($len = strlen($str)) - 1]); 
        if ($pad && $pad < $block && preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str)) { 
            $str = substr($str, 0, strlen($str) - $pad); 
        }
        return unserialize($str); 
    }
}

/**
 * 加密方式二
 */

class key_2{

    // 加密
    function encrypt($data, $key = '')
    {
     	$key = md5($key);
    	$x  = 0;
    	$len = strlen($data);
    	$l  = strlen($key);
    	$char='';
    	$str='';
    	for ($i = 0; $i < $len; $i++)
    	{
    		if ($x == $l) 
    		{
    		$x = 0;
            }
            $char.= $key{$x};
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
        }
        return base64_encode($str);
    }

    // 解密
    function decrypt($data, $key = '')
    {
    	$key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $len = strlen($data);
        $l = strlen($key);
        $char='';
        $str='';
        for ($i = 0; $i < $len; $i++)
        {
            if ($x == $l) 
            {
    		$x = 0;
            }
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
            {
    	$str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            }
            else
            {
    	$str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return $str;
    }
}