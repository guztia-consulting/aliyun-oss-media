<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Exception;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface;
/**
 * Exception when an HTTP error occurs (4xx or 5xx error)
 */
class BadResponseException extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Exception\RequestException
{
    public function __construct($message, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface $request, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response = null, \Exception $previous = null, array $handlerContext = [])
    {
        if (null === $response) {
            @trigger_error('Instantiating the ' . __CLASS__ . ' class without a Response is deprecated since version 6.3 and will be removed in 7.0.', E_USER_DEPRECATED);
        }
        parent::__construct($message, $request, $response, $previous, $handlerContext);
    }
}
