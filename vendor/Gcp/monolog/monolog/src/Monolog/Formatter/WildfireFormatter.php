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
namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger;
/**
 * Serializes a log message according to Wildfire's header requirements
 *
 * @author Eric Clemmons (@ericclemmons) <eric@uxdriven.com>
 * @author Christophe Coevoet <stof@notk.org>
 * @author Kirill chEbba Chebunin <iam@chebba.org>
 */
class WildfireFormatter extends \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\NormalizerFormatter
{
    /**
     * Translates Monolog log levels to Wildfire levels.
     */
    private $logLevels = [\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::DEBUG => 'LOG', \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::INFO => 'INFO', \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::NOTICE => 'INFO', \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::WARNING => 'WARN', \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::ERROR => 'ERROR', \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::CRITICAL => 'ERROR', \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::ALERT => 'ERROR', \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::EMERGENCY => 'ERROR'];
    /**
     * {@inheritdoc}
     */
    public function format(array $record) : string
    {
        // Retrieve the line and file if set and remove them from the formatted extra
        $file = $line = '';
        if (isset($record['extra']['file'])) {
            $file = $record['extra']['file'];
            unset($record['extra']['file']);
        }
        if (isset($record['extra']['line'])) {
            $line = $record['extra']['line'];
            unset($record['extra']['line']);
        }
        $record = $this->normalize($record);
        $message = ['message' => $record['message']];
        $handleError = false;
        if ($record['context']) {
            $message['context'] = $record['context'];
            $handleError = true;
        }
        if ($record['extra']) {
            $message['extra'] = $record['extra'];
            $handleError = true;
        }
        if (count($message) === 1) {
            $message = reset($message);
        }
        if (isset($record['context']['table'])) {
            $type = 'TABLE';
            $label = $record['channel'] . ': ' . $record['message'];
            $message = $record['context']['table'];
        } else {
            $type = $this->logLevels[$record['level']];
            $label = $record['channel'];
        }
        // Create JSON object describing the appearance of the message in the console
        $json = $this->toJson([['Type' => $type, 'File' => $file, 'Line' => $line, 'Label' => $label], $message], $handleError);
        // The message itself is a serialization of the above JSON object + it's length
        return sprintf('%d|%s|', strlen($json), $json);
    }
    /**
     * {@inheritdoc}
     */
    public function formatBatch(array $records)
    {
        throw new \BadMethodCallException('Batch formatting does not make sense for the WildfireFormatter');
    }
    /**
     * {@inheritdoc}
     * @suppress PhanTypeMismatchReturn
     */
    protected function normalize($data, int $depth = 0)
    {
        if (is_object($data) && !$data instanceof \DateTimeInterface) {
            return $data;
        }
        return parent::normalize($data, $depth);
    }
}
