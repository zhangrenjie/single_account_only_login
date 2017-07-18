<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 17-7-17
 * Time: 下午3:59
 */
@session_start();
@include_once './Login.php';
use Model\Login;

echo "正在登录....<br/>";
$userInfo = [
    'user_id' => 1,
    'user_name' => 'administrator',
    'nick_name' => '超级管理员',
];
$result = Login::doLogin($userInfo);

if ($result) {
    header('Location:./admin.php');
} else {
    echo 'Sorry,Login failed;';
    sleep(5);
    Login::doLogout();
    header('Location:./login.php');
}




