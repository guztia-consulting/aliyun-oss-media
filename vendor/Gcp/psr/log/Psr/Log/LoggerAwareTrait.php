<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Log;

/**
 * Basic Implementation of LoggerAwareInterface.
 */
trait LoggerAwareTrait
{
    /**
     * The logger instance.
     *
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
