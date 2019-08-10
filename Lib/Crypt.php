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
 * | @package 加密解密
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */

// 加密
function encrypt($data, $key) { 
	$prep_code = serialize($data); 
	$block = mcrypt_get_block_size('des', 'ecb'); 
	if (($pad = $block - (strlen($prep_code) % $block)) < $block) { 
		$prep_code .= str_repeat(chr($pad), $pad); 
	} 
	$encrypt = mcrypt_encrypt(MCRYPT_DES, $key, $prep_code, MCRYPT_MODE_ECB); 
	return base64_encode($encrypt); 
}

// 解密
function decrypt($str, $key) { 
	$str = base64_decode($str); 
	$str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB); 
	$block = mcrypt_get_block_size('des', 'ecb'); 
	$pad = ord($str[($len = strlen($str)) - 1]); 
	if ($pad && $pad < $block && preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str)) { 
		$str = substr($str, 0, strlen($str) - $pad); 
	}
	return unserialize($str); 
}