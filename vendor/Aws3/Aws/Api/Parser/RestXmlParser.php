<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Service;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface;
/**
 * @internal Implements REST-XML parsing (e.g., S3, CloudFront, etc...)
 */
class RestXmlParser extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\AbstractRestParser
{
    use PayloadParserTrait;
    /**
     * @param Service   $api    Service description
     * @param XmlParser $parser XML body parser
     */
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Service $api, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\XmlParser $parser = null)
    {
        parent::__construct($api);
        $this->parser = $parser ?: new \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\XmlParser();
    }
    protected function payload(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member, array &$result)
    {
        $result += $this->parseMemberFromStream($response->getBody(), $member, $response);
    }
    public function parseMemberFromStream(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface $stream, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member, $response)
    {
        $xml = $this->parseXml($stream, $response);
        return $this->parser->parse($member, $xml);
    }
}
