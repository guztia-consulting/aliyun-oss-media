<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\S3\UseArnRegion\Exception;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\HasMonitoringEventsTrait;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\MonitoringEventsInterface;
/**
 * Represents an error interacting with configuration for S3's UseArnRegion
 */
class ConfigurationException extends \RuntimeException implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
