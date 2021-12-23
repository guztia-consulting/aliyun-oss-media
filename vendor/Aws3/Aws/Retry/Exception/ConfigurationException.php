<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Retry\Exception;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\HasMonitoringEventsTrait;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\MonitoringEventsInterface;
/**
 * Represents an error interacting with retry configuration
 */
class ConfigurationException extends \RuntimeException implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
