<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 17-7-17
 * Time: 下午6:31
 */
@session_start();
include_once './Login.php';
include_once './MemcachedLib.php';
use Model\Login;
use Cache\MemcachedLib;

if (!Login::checkLoginStatus()) {
    header('Location:./login.php');
}


echo "<h1>管理界面</h1>";

echo "<hr/>";

echo print_r($_SESSION, true);
echo "<hr/>";

echo "session_id: <br/>" . session_id();


echo "<hr/>";
echo "The session_id's value in memcached cache is: <br/>";
$memcached = new MemcachedLib();
echo $memcached->getOne('user_id_' . $_SESSION['user_id']);


echo "<hr/>";
echo "Cookies content is: ";
echo print_r($_COOKIE,true);

echo "<hr/>";
echo "<a href='./logout.php'>Logout</a>";



