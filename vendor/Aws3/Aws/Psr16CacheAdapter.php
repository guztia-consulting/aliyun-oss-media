<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\SimpleCache\CacheInterface as SimpleCacheInterface;
class Psr16CacheAdapter implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CacheInterface
{
    /** @var SimpleCacheInterface */
    private $cache;
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\SimpleCache\CacheInterface $cache)
    {
        $this->cache = $cache;
    }
    public function get($key)
    {
        return $this->cache->get($key);
    }
    public function set($key, $value, $ttl = 0)
    {
        $this->cache->set($key, $value, $ttl);
    }
    public function remove($key)
    {
        $this->cache->delete($key);
    }
}
