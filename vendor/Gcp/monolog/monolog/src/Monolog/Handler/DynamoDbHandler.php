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

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Aws\Sdk;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Aws\DynamoDb\DynamoDbClient;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\FormatterInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Aws\DynamoDb\Marshaler;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\ScalarFormatter;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger;
/**
 * Amazon DynamoDB handler (http://aws.amazon.com/dynamodb/)
 *
 * @link https://github.com/aws/aws-sdk-php/
 * @author Andrew Lawson <adlawson@gmail.com>
 */
class DynamoDbHandler extends \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Handler\AbstractProcessingHandler
{
    public const DATE_FORMAT = 'Y-m-d\\TH:i:s.uO';
    /**
     * @var DynamoDbClient
     */
    protected $client;
    /**
     * @var string
     */
    protected $table;
    /**
     * @var int
     */
    protected $version;
    /**
     * @var Marshaler
     */
    protected $marshaler;
    /**
     * @param int|string $level
     */
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Aws\DynamoDb\DynamoDbClient $client, string $table, $level = \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::DEBUG, bool $bubble = true)
    {
        if (defined('Aws\\Sdk::VERSION') && version_compare(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Aws\Sdk::VERSION, '3.0', '>=')) {
            $this->version = 3;
            $this->marshaler = new \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Aws\DynamoDb\Marshaler();
        } else {
            $this->version = 2;
        }
        $this->client = $client;
        $this->table = $table;
        parent::__construct($level, $bubble);
    }
    /**
     * {@inheritdoc}
     */
    protected function write(array $record) : void
    {
        $filtered = $this->filterEmptyFields($record['formatted']);
        if ($this->version === 3) {
            $formatted = $this->marshaler->marshalItem($filtered);
        } else {
            $formatted = $this->client->formatAttributes($filtered);
        }
        $this->client->putItem(['TableName' => $this->table, 'Item' => $formatted]);
    }
    protected function filterEmptyFields(array $record) : array
    {
        return array_filter($record, function ($value) {
            return !empty($value) || false === $value || 0 === $value;
        });
    }
    /**
     * {@inheritdoc}
     */
    protected function getDefaultFormatter() : FormatterInterface
    {
        return new \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\ScalarFormatter(self::DATE_FORMAT);
    }
}
