<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\ErrorParser;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\JsonParser;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Service;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface;
/**
 * Parsers JSON-RPC errors.
 */
class JsonRpcErrorParser extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\ErrorParser\AbstractErrorParser
{
    use JsonParserTrait;
    private $parser;
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Service $api = null, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\JsonParser $parser = null)
    {
        parent::__construct($api);
        $this->parser = $parser ?: new \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\JsonParser();
    }
    public function __invoke(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface $command = null)
    {
        $data = $this->genericHandler($response);
        // Make the casing consistent across services.
        if ($data['parsed']) {
            $data['parsed'] = array_change_key_case($data['parsed']);
        }
        if (isset($data['parsed']['__type'])) {
            $parts = explode('#', $data['parsed']['__type']);
            $data['code'] = isset($parts[1]) ? $parts[1] : $parts[0];
            $data['message'] = isset($data['parsed']['message']) ? $data['parsed']['message'] : null;
        }
        $this->populateShape($data, $response, $command);
        return $data;
    }
}
