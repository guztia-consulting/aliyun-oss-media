<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Cache\CacheItemPoolInterface;
class PsrCacheAdapter implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CacheInterface
{
    /** @var CacheItemPoolInterface */
    private $pool;
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Cache\CacheItemPoolInterface $pool)
    {
        $this->pool = $pool;
    }
    public function get($key)
    {
        $item = $this->pool->getItem($key);
        return $item->isHit() ? $item->get() : null;
    }
    public function set($key, $value, $ttl = 0)
    {
        $item = $this->pool->getItem($key);
        $item->set($value);
        if ($ttl > 0) {
            $item->expiresAfter($ttl);
        }
        $this->pool->save($item);
    }
    public function remove($key)
    {
        $this->pool->deleteItem($key);
    }
}
