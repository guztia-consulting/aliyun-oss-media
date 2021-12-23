<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\S3\Crypto;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\AwsClientInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Middleware;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface;
trait UserAgentTrait
{
    private function appendUserAgent(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\AwsClientInterface $client, $agentString)
    {
        $list = $client->getHandlerList();
        $list->appendBuild(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Middleware::mapRequest(function (\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface $req) use($agentString) {
            if (!empty($req->getHeader('User-Agent')) && !empty($req->getHeader('User-Agent')[0])) {
                $userAgent = $req->getHeader('User-Agent')[0];
                if (strpos($userAgent, $agentString) === false) {
                    $userAgent .= " {$agentString}";
                }
            } else {
                $userAgent = $agentString;
            }
            $req = $req->withHeader('User-Agent', $userAgent);
            return $req;
        }));
    }
}
