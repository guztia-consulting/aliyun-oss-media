<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Service;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface;
/**
 * @internal Implements REST-JSON parsing (e.g., Glacier, Elastic Transcoder)
 */
class RestJsonParser extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\AbstractRestParser
{
    use PayloadParserTrait;
    /**
     * @param Service    $api    Service description
     * @param JsonParser $parser JSON body builder
     */
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Service $api, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\JsonParser $parser = null)
    {
        parent::__construct($api);
        $this->parser = $parser ?: new \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\JsonParser();
    }
    protected function payload(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member, array &$result)
    {
        $jsonBody = $this->parseJson($response->getBody(), $response);
        if ($jsonBody) {
            $result += $this->parser->parse($member, $jsonBody);
        }
    }
    public function parseMemberFromStream(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface $stream, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member, $response)
    {
        $jsonBody = $this->parseJson($stream, $response);
        if ($jsonBody) {
            return $this->parser->parse($member, $jsonBody);
        }
        return [];
    }
}
