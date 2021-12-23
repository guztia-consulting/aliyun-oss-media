<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\S3\UseArnRegion;

use Aws;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\S3\UseArnRegion\Exception\ConfigurationException;
class Configuration implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\S3\UseArnRegion\ConfigurationInterface
{
    private $useArnRegion;
    public function __construct($useArnRegion)
    {
        $this->useArnRegion = \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\boolean_value($useArnRegion);
        if (is_null($this->useArnRegion)) {
            throw new \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\S3\UseArnRegion\Exception\ConfigurationException("'use_arn_region' config option" . " must be a boolean value.");
        }
    }
    /**
     * {@inheritdoc}
     */
    public function isUseArnRegion()
    {
        return $this->useArnRegion;
    }
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return ['use_arn_region' => $this->isUseArnRegion()];
    }
}
