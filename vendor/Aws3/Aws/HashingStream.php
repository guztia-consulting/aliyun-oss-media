<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Psr7\StreamDecoratorTrait;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface;
/**
 * Stream decorator that calculates a rolling hash of the stream as it is read.
 */
class HashingStream implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface
{
    use StreamDecoratorTrait;
    /** @var HashInterface */
    private $hash;
    /** @var callable|null */
    private $callback;
    /**
     * @param StreamInterface $stream     Stream that is being read.
     * @param HashInterface   $hash       Hash used to calculate checksum.
     * @param callable        $onComplete Optional function invoked when the
     *                                    hash calculation is completed.
     */
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\StreamInterface $stream, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\HashInterface $hash, callable $onComplete = null)
    {
        $this->stream = $stream;
        $this->hash = $hash;
        $this->callback = $onComplete;
    }
    public function read($length)
    {
        $data = $this->stream->read($length);
        $this->hash->update($data);
        if ($this->eof()) {
            $result = $this->hash->complete();
            if ($this->callback) {
                call_user_func($this->callback, $result);
            }
        }
        return $data;
    }
    public function seek($offset, $whence = SEEK_SET)
    {
        if ($offset === 0) {
            $this->hash->reset();
            return $this->stream->seek($offset);
        }
        // Seeking arbitrarily is not supported.
        return false;
    }
}
