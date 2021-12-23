<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\MessageInterface;
final class BodySummarizer implements \GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\BodySummarizerInterface
{
    /**
     * @var int|null
     */
    private $truncateAt;
    public function __construct(int $truncateAt = null)
    {
        $this->truncateAt = $truncateAt;
    }
    /**
     * Returns a summarized message body.
     */
    public function summarize(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\MessageInterface $message) : ?string
    {
        return $this->truncateAt === null ? \GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Psr7\Message::bodySummary($message) : \GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp\Psr7\Message::bodySummary($message, $this->truncateAt);
    }
}
