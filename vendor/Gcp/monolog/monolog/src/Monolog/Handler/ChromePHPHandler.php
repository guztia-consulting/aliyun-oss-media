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

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\ChromePHPFormatter;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\FormatterInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger;
use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Utils;
/**
 * Handler sending logs to the ChromePHP extension (http://www.chromephp.com/)
 *
 * This also works out of the box with Firefox 43+
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ChromePHPHandler extends \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Handler\AbstractProcessingHandler
{
    use WebRequestRecognizerTrait;
    /**
     * Version of the extension
     */
    protected const VERSION = '4.0';
    /**
     * Header name
     */
    protected const HEADER_NAME = 'X-ChromeLogger-Data';
    /**
     * Regular expression to detect supported browsers (matches any Chrome, or Firefox 43+)
     */
    protected const USER_AGENT_REGEX = '{\\b(?:Chrome/\\d+(?:\\.\\d+)*|HeadlessChrome|Firefox/(?:4[3-9]|[5-9]\\d|\\d{3,})(?:\\.\\d)*)\\b}';
    protected static $initialized = false;
    /**
     * Tracks whether we sent too much data
     *
     * Chrome limits the headers to 4KB, so when we sent 3KB we stop sending
     *
     * @var bool
     */
    protected static $overflowed = false;
    protected static $json = ['version' => self::VERSION, 'columns' => ['label', 'log', 'backtrace', 'type'], 'rows' => []];
    protected static $sendHeaders = true;
    /**
     * @param string|int $level  The minimum logging level at which this handler will be triggered
     * @param bool       $bubble Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct($level = \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        if (!function_exists('json_encode')) {
            throw new \RuntimeException('PHP\'s json extension is required to use Monolog\'s ChromePHPHandler');
        }
    }
    /**
     * {@inheritdoc}
     */
    public function handleBatch(array $records) : void
    {
        if (!$this->isWebRequest()) {
            return;
        }
        $messages = [];
        foreach ($records as $record) {
            if ($record['level'] < $this->level) {
                continue;
            }
            $messages[] = $this->processRecord($record);
        }
        if (!empty($messages)) {
            $messages = $this->getFormatter()->formatBatch($messages);
            self::$json['rows'] = array_merge(self::$json['rows'], $messages);
            $this->send();
        }
    }
    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter() : FormatterInterface
    {
        return new \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Formatter\ChromePHPFormatter();
    }
    /**
     * Creates & sends header for a record
     *
     * @see sendHeader()
     * @see send()
     */
    protected function write(array $record) : void
    {
        if (!$this->isWebRequest()) {
            return;
        }
        self::$json['rows'][] = $record['formatted'];
        $this->send();
    }
    /**
     * Sends the log header
     *
     * @see sendHeader()
     */
    protected function send() : void
    {
        if (self::$overflowed || !self::$sendHeaders) {
            return;
        }
        if (!self::$initialized) {
            self::$initialized = true;
            self::$sendHeaders = $this->headersAccepted();
            if (!self::$sendHeaders) {
                return;
            }
            self::$json['request_uri'] = $_SERVER['REQUEST_URI'] ?? '';
        }
        $json = \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Utils::jsonEncode(self::$json, null, true);
        $data = base64_encode(utf8_encode($json));
        if (strlen($data) > 3 * 1024) {
            self::$overflowed = true;
            $record = ['message' => 'Incomplete logs, chrome header size limit reached', 'context' => [], 'level' => \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::WARNING, 'level_name' => \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::getLevelName(\GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::WARNING), 'channel' => 'monolog', 'datetime' => new \DateTimeImmutable(), 'extra' => []];
            self::$json['rows'][count(self::$json['rows']) - 1] = $this->getFormatter()->format($record);
            $json = \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Utils::jsonEncode(self::$json, null, true);
            $data = base64_encode(utf8_encode($json));
        }
        if (trim($data) !== '') {
            $this->sendHeader(static::HEADER_NAME, $data);
        }
    }
    /**
     * Send header string to the client
     */
    protected function sendHeader(string $header, string $content) : void
    {
        if (!headers_sent() && self::$sendHeaders) {
            header(sprintf('%s: %s', $header, $content));
        }
    }
    /**
     * Verifies if the headers are accepted by the current user agent
     */
    protected function headersAccepted() : bool
    {
        if (empty($_SERVER['HTTP_USER_AGENT'])) {
            return false;
        }
        return preg_match(static::USER_AGENT_REGEX, $_SERVER['HTTP_USER_AGENT']) === 1;
    }
}
