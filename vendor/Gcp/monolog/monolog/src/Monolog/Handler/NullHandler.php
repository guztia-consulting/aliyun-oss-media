<?php

declare (strict_types=1);
/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Handler;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger;
/**
 * Blackhole
 *
 * Any record it can handle will be thrown away. This can be used
 * to put on top of an existing stack to override it temporarily.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class NullHandler extends \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Handler\Handler
{
    /**
     * @var int
     */
    private $level;
    /**
     * @param string|int $level The minimum logging level at which this handler will be triggered
     */
    public function __construct($level = \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::DEBUG)
    {
        $this->level = \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::toMonologLevel($level);
    }
    /**
     * {@inheritdoc}
     */
    public function isHandling(array $record) : bool
    {
        return $record['level'] >= $this->level;
    }
    /**
     * {@inheritdoc}
     */
    public function handle(array $record) : bool
    {
        return $record['level'] >= $this->level;
    }
}
