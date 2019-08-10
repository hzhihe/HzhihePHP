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
 * | @package php页面防重复提交方法
 * | @author IJomu <ijomu@vip.qq.com>
 * |
 * |********************************************************************
 */
function checkRepeatSubmit($uniqueid = '', $expire = 30) {
    $uniqueid = empty($uniqueid) ? Yii::app()->user->id . Yii::app()->user->name . Yii::app()->user->mihome : $uniqueid;
    $token = md5("wms_check_repeat" . $uniqueid);
    $time = time();
    if (isset($_SESSION['token']) && !empty($_SESSION['token']) && $_SESSION['token'] == $token && ($time - $_SESSION['expire_time'] < $expire)) {
        return false;
    } else {
        $_SESSION['token'] = $token;
        $_SESSION['expire_time'] = $time;
        //session写入的时候会等待整个页面加载完成，用此函数可以立即写入
        session_write_close();
        return true;
    }
}
//删除存入的值
function cancelRepeatSubmit() {
    unset($_SESSION['token']);
    unset($_SESSION['expire_time']);
}