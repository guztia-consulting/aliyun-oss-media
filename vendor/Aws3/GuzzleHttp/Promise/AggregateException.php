<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Promise;

/**
 * Exception thrown when too many errors occur in the some() or any() methods.
 */
class AggregateException extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\GuzzleHttp\Promise\RejectionException
{
    public function __construct($msg, array $reasons)
    {
        parent::__construct($reasons, sprintf('%s; %d rejected promises', $msg, count($reasons)));
    }
}
