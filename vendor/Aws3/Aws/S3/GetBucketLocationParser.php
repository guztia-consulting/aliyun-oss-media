<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\S3;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\AbstractParser;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface;
/**
 * @internal Decorates a parser for the S3 service to correctly handle the
 *           GetBucketLocation operation.
 */
class GetBucketLocationParser extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\AbstractParser
{
    /**
     * @param callable $parser Parser to wrap.
     */
    public function __construct(callable $parser)
    {
        $this->parser = $parser;
    }
    public function __invoke(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface $command, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response)
    {
        $fn = $this->parser;
        $result = $fn($command, $response);
        if ($command->getName() === 'GetBucketLocation') {
            $location = 'us-east-1';
            if (preg_match('/>(.+?)<\\/LocationConstraint>/', $response->getBody(), $matches)) {
                $location = $matches[1] === 'EU' ? 'eu-west-1' : $matches[1];
            }
            $result['LocationConstraint'] = $location;
        }
        return $result;
    }
    public function parseMemberFromStream(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface $stream, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member, $response)
    {
        return $this->parser->parseMemberFromStream($stream, $member, $response);
    }
}
