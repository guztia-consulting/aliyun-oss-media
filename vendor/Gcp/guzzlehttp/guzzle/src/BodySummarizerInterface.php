<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\GuzzleHttp;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\MessageInterface;
interface BodySummarizerInterface
{
    /**
     * Returns a summarized message body.
     */
    public function summarize(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Http\Message\MessageInterface $message) : ?string;
}
