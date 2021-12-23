<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\ErrorParser;

use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\MetadataParserTrait;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Parser\PayloadParserTrait;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Service;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface;
use GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface;
abstract class AbstractErrorParser
{
    use MetadataParserTrait;
    use PayloadParserTrait;
    /**
     * @var Service
     */
    protected $api;
    /**
     * @param Service $api
     */
    public function __construct(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\Service $api = null)
    {
        $this->api = $api;
    }
    protected abstract function payload(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member);
    protected function extractPayload(\GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\StructureShape $member, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response)
    {
        if ($member instanceof StructureShape) {
            // Structure members parse top-level data into a specific key.
            return $this->payload($response, $member);
        } else {
            // Streaming data is just the stream from the response body.
            return $response->getBody();
        }
    }
    protected function populateShape(array &$data, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Psr\Http\Message\ResponseInterface $response, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\CommandInterface $command = null)
    {
        $data['body'] = [];
        if (!empty($command) && !empty($this->api)) {
            // If modeled error code is indicated, check for known error shape
            if (!empty($data['code'])) {
                $errors = $this->api->getOperation($command->getName())->getErrors();
                foreach ($errors as $key => $error) {
                    // If error code matches a known error shape, populate the body
                    if ($data['code'] == $error['name'] && $error instanceof StructureShape) {
                        $modeledError = $error;
                        $data['body'] = $this->extractPayload($modeledError, $response);
                        $data['error_shape'] = $modeledError;
                        foreach ($error->getMembers() as $name => $member) {
                            switch ($member['location']) {
                                case 'header':
                                    $this->extractHeader($name, $member, $response, $data['body']);
                                    break;
                                case 'headers':
                                    $this->extractHeaders($name, $member, $response, $data['body']);
                                    break;
                                case 'statusCode':
                                    $this->extractStatus($name, $response, $data['body']);
                                    break;
                            }
                        }
                        break;
                    }
                }
            }
        }
        return $data;
    }
}
