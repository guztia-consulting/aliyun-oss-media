<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Promise;

final class Is
{
    /**
     * Returns true if a promise is pending.
     *
     * @return bool
     */
    public static function pending(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled or rejected.
     *
     * @return bool
     */
    public static function settled(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() !== \GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled.
     *
     * @return bool
     */
    public static function fulfilled(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Promise\PromiseInterface::FULFILLED;
    }
    /**
     * Returns true if a promise is rejected.
     *
     * @return bool
     */
    public static function rejected(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Promise\PromiseInterface::REJECTED;
    }
}
