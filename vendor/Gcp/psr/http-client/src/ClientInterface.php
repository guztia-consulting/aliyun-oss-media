<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Client;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\RequestInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\ResponseInterface;
interface ClientInterface
{
    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface If an error happens while processing the request.
     */
    public function sendRequest(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\RequestInterface $request) : ResponseInterface;
}
