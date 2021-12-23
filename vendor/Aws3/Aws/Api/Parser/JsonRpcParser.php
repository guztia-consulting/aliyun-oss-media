<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Service;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Result;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface;
/**
 * @internal Implements JSON-RPC parsing (e.g., DynamoDB)
 */
class JsonRpcParser extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\AbstractParser
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
    public function __invoke(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface $command, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response)
    {
        $operation = $this->api->getOperation($command->getName());
        $result = null === $operation['output'] ? null : $this->parseMemberFromStream($response->getBody(), $operation->getOutput(), $response);
        return new \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Result($result ?: []);
    }
    public function parseMemberFromStream(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface $stream, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member, $response)
    {
        return $this->parser->parse($member, $this->parseJson($stream, $response));
    }
}
