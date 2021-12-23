<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\RequestInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\ResponseInterface;
interface MessageFormatterInterface
{
    /**
     * Returns a formatted message string.
     *
     * @param RequestInterface       $request  Request that was sent
     * @param ResponseInterface|null $response Response that was received
     * @param \Throwable|null        $error    Exception that was received
     */
    public function format(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\RequestInterface $request, ?ResponseInterface $response = null, ?\Throwable $error = null) : string;
}
