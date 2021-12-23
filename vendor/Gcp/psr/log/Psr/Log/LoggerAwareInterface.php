<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Log;

/**
 * Describes a logger-aware instance.
 */
interface LoggerAwareInterface
{
    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function setLogger(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Log\LoggerInterface $logger);
}
