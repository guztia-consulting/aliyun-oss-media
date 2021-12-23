<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\S3;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Arn\ArnInterface;
/**
 * @internal
 */
interface BucketArnInterface extends ArnInterface
{
    public function getBucketName();
}
