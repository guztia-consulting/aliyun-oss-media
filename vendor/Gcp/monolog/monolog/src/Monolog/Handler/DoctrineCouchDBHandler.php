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
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\NormalizerFormatter;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\FormatterInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Doctrine\CouchDB\CouchDBClient;
/**
 * CouchDB handler for Doctrine CouchDB ODM
 *
 * @author Markus Bachmann <markus.bachmann@bachi.biz>
 */
class DoctrineCouchDBHandler extends \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Handler\AbstractProcessingHandler
{
    private $client;
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Doctrine\CouchDB\CouchDBClient $client, $level = \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::DEBUG, bool $bubble = true)
    {
        $this->client = $client;
        parent::__construct($level, $bubble);
    }
    /**
     * {@inheritDoc}
     */
    protected function write(array $record) : void
    {
        $this->client->postDocument($record['formatted']);
    }
    protected function getDefaultFormatter() : FormatterInterface
    {
        return new \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\NormalizerFormatter();
    }
}
