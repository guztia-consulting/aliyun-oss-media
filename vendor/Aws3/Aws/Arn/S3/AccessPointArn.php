<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\S3;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\AccessPointArn as BaseAccessPointArn;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\AccessPointArnInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\ArnInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\Exception\InvalidArnException;
/**
 * @internal
 */
class AccessPointArn extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\AccessPointArn implements \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\AccessPointArnInterface
{
    /**
     * Validation specific to AccessPointArn
     *
     * @param array $data
     */
    protected static function validate(array $data)
    {
        parent::validate($data);
        if ($data['service'] !== 's3') {
            throw new \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\Exception\InvalidArnException("The 3rd component of an S3 access" . " point ARN represents the region and must be 's3'.");
        }
    }
}
