<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Signature;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Credentials\CredentialsInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface;
/**
 * Provides anonymous client access (does not sign requests).
 */
class AnonymousSignature implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Signature\SignatureInterface
{
    public function signRequest(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface $request, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Credentials\CredentialsInterface $credentials)
    {
        return $request;
    }
    public function presign(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\RequestInterface $request, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Credentials\CredentialsInterface $credentials, $expires, array $options = [])
    {
        return $request;
    }
}
