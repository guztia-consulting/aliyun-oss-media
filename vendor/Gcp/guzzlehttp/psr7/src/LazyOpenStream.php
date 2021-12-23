<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Psr7;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\StreamInterface;
/**
 * Lazily reads or writes to a file that is opened only after an IO operation
 * take place on the stream.
 */
class LazyOpenStream implements \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\StreamInterface
{
    use StreamDecoratorTrait;
    /** @var string File to open */
    private $filename;
    /** @var string $mode */
    private $mode;
    /**
     * @param string $filename File to lazily open
     * @param string $mode     fopen mode to use when opening the stream
     */
    public function __construct($filename, $mode)
    {
        $this->filename = $filename;
        $this->mode = $mode;
    }
    /**
     * Creates the underlying stream lazily when required.
     *
     * @return StreamInterface
     */
    protected function createStream()
    {
        return \GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Psr7\Utils::streamFor(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Psr7\Utils::tryFopen($this->filename, $this->mode));
    }
}
