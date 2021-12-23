<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Exception;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\RequestInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\ResponseInterface;
/**
 * Exception when an HTTP error occurs (4xx or 5xx error)
 */
class BadResponseException extends \GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Exception\RequestException
{
    public function __construct(string $message, \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\RequestInterface $request, \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\ResponseInterface $response, \Throwable $previous = null, array $handlerContext = [])
    {
        parent::__construct($message, $request, $response, $previous, $handlerContext);
    }
    /**
     * Current exception and the ones that extend it will always have a response.
     */
    public function hasResponse() : bool
    {
        return true;
    }
    /**
     * This function narrows the return type from the parent class and does not allow it to be nullable.
     */
    public function getResponse() : ResponseInterface
    {
        /** @var ResponseInterface */
        return parent::getResponse();
    }
}
