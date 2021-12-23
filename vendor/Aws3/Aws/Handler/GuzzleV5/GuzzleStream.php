<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Handler\GuzzleV5;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Stream\StreamDecoratorTrait;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Stream\StreamInterface as GuzzleStreamInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface as Psr7StreamInterface;
/**
 * Adapts a PSR-7 Stream to a Guzzle 5 Stream.
 *
 * @codeCoverageIgnore
 */
class GuzzleStream implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Stream\StreamInterface
{
    use StreamDecoratorTrait;
    /** @var Psr7StreamInterface */
    private $stream;
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface $stream)
    {
        $this->stream = $stream;
    }
}
