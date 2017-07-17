<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 17-7-17
 * Time: 下午3:59
 */
@session_start();
include_once './Login.php';
use Model\Login;

Login::doLogout();
header('Location:./login.php');





