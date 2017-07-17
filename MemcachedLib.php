<?php

/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 17-7-17
 * Time: 下午4:11
 */
namespace Cache;

class MemcachedLib
{
    public $memcached;

    //初始化
    public function __construct()
    {
        $this->memcached = new \Memcached();
        $this->memcached->addServer('localhost', '11211');

        return $this->memcached;
    }

    //获取一条记录
    public function getOne(string $key)
    {
        return $this->memcached->get($key);
    }

    //添加一条记录(值可以是任何有效的非资源型php类型， 因为资源类型不能被序列化存储。)
    public function addOne(string $key, string $value, int $expiration = 0)
    {
        return $this->memcached->add($key, $value, $expiration);
    }

    //添加一条记录(有则替换无则创建)
    public function setOne(string $key, string $value, int $expiration = 0)
    {
        return $this->memcached->add($key, $value, $expiration);
    }

    public function deleteOne(string $key)
    {
        if ($this->memcached->delete($key) !== false) {
            return true;
        } else {
            return false;
        }
    }
}