<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\ClientSideMonitoring;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Exception\AwsException;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\ResultInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Psr7\Request;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface;
/**
 * @internal
 */
interface MonitoringMiddlewareInterface
{
    /**
     * Data for event properties to be sent to the monitoring agent.
     *
     * @param RequestInterface $request
     * @return array
     */
    public static function getRequestData(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface $request);
    /**
     * Data for event properties to be sent to the monitoring agent.
     *
     * @param ResultInterface|AwsException|\Exception $klass
     * @return array
     */
    public static function getResponseData($klass);
    public function __invoke(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface $cmd, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface $request);
}
