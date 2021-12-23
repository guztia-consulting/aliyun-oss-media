<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\EndpointDiscovery\Exception;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\HasMonitoringEventsTrait;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\MonitoringEventsInterface;
/**
 * Represents an error interacting with configuration for endpoint discovery
 */
class ConfigurationException extends \RuntimeException implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
