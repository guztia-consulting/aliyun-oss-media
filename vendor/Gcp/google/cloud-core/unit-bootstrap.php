<?php

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Google\ApiCore\Testing\MessageAwareArrayComparator;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Google\ApiCore\Testing\ProtobufMessageComparator;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Google\ApiCore\Testing\ProtobufGPBEmptyComparator;
\date_default_timezone_set('UTC');
\GuztiaConsulting\Aliyun_OSS_Media\Gcp\SebastianBergmann\Comparator\Factory::getInstance()->register(new \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Google\ApiCore\Testing\MessageAwareArrayComparator());
\GuztiaConsulting\Aliyun_OSS_Media\Gcp\SebastianBergmann\Comparator\Factory::getInstance()->register(new \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Google\ApiCore\Testing\ProtobufMessageComparator());
\GuztiaConsulting\Aliyun_OSS_Media\Gcp\SebastianBergmann\Comparator\Factory::getInstance()->register(new \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Google\ApiCore\Testing\ProtobufGPBEmptyComparator());
