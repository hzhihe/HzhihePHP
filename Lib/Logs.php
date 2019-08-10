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
 * | @package 系统日记
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
function Logs($title, $centent, $file = 'Log')
{
    /**
     * 1.确定文件储存位置是否存在
     * 新建目录
     * 2.写入日志
     */
    date_default_timezone_set('PRC'); //设置中国时区

    if(!is_dir(APP_LOG)){
        mkdir(APP_LOG,0777,true);
    }

    if(is_array($centent))
    {
        $centent = json_encode($centent);
    }else{
        $centent = $centent;
    }

    return file_put_contents(APP_LOG.$file.'.log','['.@date('Y-m-d H:i:s').'] ['.$title.'] '.$centent.PHP_EOL,FILE_APPEND);
}