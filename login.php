<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 17-7-17
 * Time: 下午3:59
 */
session_start();

include_once './Login.php';
//use Cache\MemcachedLib;
use Model\Login;

if(Login::checkLoginStatus()){
    header('Location:admin.php');
}

echo '请登录...';
echo "<hr/>";
echo "<a href='./autologin.php'>点击登录</a>";



