<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 17-7-17
 * Time: 下午4:10
 */
namespace Model;
@session_start();
@require './MemcachedLib.php';
use Cache\MemcachedLib;

class Login
{
    static $cacheSessionIdKey = 'user_id_%d';

    public static function checkLoginStatus()
    {
        if (empty($_SESSION)) return false;
        $sessionUserId = $_SESSION['user_id'] ?? 0;
        if ($sessionUserId && self::getSessionId() == self::getCacheSessionId($sessionUserId)) {
            return true;
        } else {
            self::doLogout();
            return false;
        }
    }

    public static function getCacheSessionId(int $userId)
    {
        $key = sprintf(self::$cacheSessionIdKey, $userId);
        $memcached = new MemcachedLib();
        return $memcached->getOne($key);
    }

    public static function setCacheSessionId(int $userId)
    {
        $key = sprintf(self::$cacheSessionIdKey, $userId);
        $memcached = new MemcachedLib();
        $memcached->deleteOne($key);
        return $memcached->addOne($key, session_id(), 86400);
    }

    public static function deleteCacheSessionId(int $userId)
    {
        $key = sprintf(self::$cacheSessionIdKey, $userId);
        $memcached = new MemcachedLib();
        return $memcached->deleteOne($key);
    }

    public static function getSessionId()
    {
        return session_id();
    }

    public static function doLogin(array $userInfo)
    {
        $_SESSION['user_id'] = $userInfo['user_id'];
        $_SESSION['user_name'] = $userInfo['user_name'];
        $_SESSION['nick_name'] = $userInfo['nick_name'] . date('Y-m-d H:i:s');
        self::setCacheSessionId($userInfo['user_id']);
        return true;
    }

    public static function doLogout()
    {
        $sessionName = session_name();
        @setcookie($sessionName, null);
        unset($_SESSION);
        return true;
    }
}
