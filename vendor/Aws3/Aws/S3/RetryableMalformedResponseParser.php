<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\S3;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\AbstractParser;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\Exception\ParserException;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Exception\AwsException;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface;
/**
 * Converts malformed responses to a retryable error type.
 *
 * @internal
 */
class RetryableMalformedResponseParser extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\AbstractParser
{
    /** @var string */
    private $exceptionClass;
    public function __construct(callable $parser, $exceptionClass = \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Exception\AwsException::class)
    {
        $this->parser = $parser;
        $this->exceptionClass = $exceptionClass;
    }
    public function __invoke(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface $command, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response)
    {
        $fn = $this->parser;
        try {
            return $fn($command, $response);
        } catch (ParserException $e) {
            throw new $this->exceptionClass("Error parsing response for {$command->getName()}:" . " AWS parsing error: {$e->getMessage()}", $command, ['connection_error' => true, 'exception' => $e], $e);
        }
    }
    public function parseMemberFromStream(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface $stream, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member, $response)
    {
        return $this->parser->parseMemberFromStream($stream, $member, $response);
    }
}
