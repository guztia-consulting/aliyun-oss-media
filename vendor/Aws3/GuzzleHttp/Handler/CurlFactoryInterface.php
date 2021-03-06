<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Handler;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface;
interface CurlFactoryInterface
{
    /**
     * Creates a cURL handle resource.
     *
     * @param RequestInterface $request Request
     * @param array            $options Transfer options
     *
     * @return EasyHandle
     * @throws \RuntimeException when an option cannot be applied
     */
    public function create(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface $request, array $options);
    /**
     * Release an easy handle, allowing it to be reused or closed.
     *
     * This function must call unset on the easy handle's "handle" property.
     *
     * @param EasyHandle $easy
     */
    public function release(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Handler\EasyHandle $easy);
}
