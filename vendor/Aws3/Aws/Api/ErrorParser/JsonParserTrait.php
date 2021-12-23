<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\ErrorParser;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\PayloadParserTrait;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface;
/**
 * Provides basic JSON error parsing functionality.
 */
trait JsonParserTrait
{
    use PayloadParserTrait;
    private function genericHandler(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response)
    {
        $code = (string) $response->getStatusCode();
        return ['request_id' => (string) $response->getHeaderLine('x-amzn-requestid'), 'code' => null, 'message' => null, 'type' => $code[0] == '4' ? 'client' : 'server', 'parsed' => $this->parseJson($response->getBody(), $response)];
    }
    protected function payload(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member)
    {
        $jsonBody = $this->parseJson($response->getBody(), $response);
        if ($jsonBody) {
            return $this->parser->parse($member, $jsonBody);
        }
    }
}
