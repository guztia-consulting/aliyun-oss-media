<?php

namespace GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api;

/**
 * Base class representing a modeled shape.
 */
class Shape extends \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\AbstractModel
{
    /**
     * Get a concrete shape for the given definition.
     *
     * @param array    $definition
     * @param ShapeMap $shapeMap
     *
     * @return mixed
     * @throws \RuntimeException if the type is invalid
     */
    public static function create(array $definition, \GuztiaConsulting\Aliyun_OSS_Media\Aws3\Aws\Api\ShapeMap $shapeMap)
    {
        static $map = ['structure' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\StructureShape', 'map' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\MapShape', 'list' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\ListShape', 'timestamp' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\TimestampShape', 'integer' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\Shape', 'double' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\Shape', 'float' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\Shape', 'long' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\Shape', 'string' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\Shape', 'byte' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\Shape', 'character' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\Shape', 'blob' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\Shape', 'boolean' => 'GuztiaConsulting\\Aliyun_OSS_Media\\Aws3\\Aws\\Api\\Shape'];
        if (isset($definition['shape'])) {
            return $shapeMap->resolve($definition);
        }
        if (!isset($map[$definition['type']])) {
            throw new \RuntimeException('Invalid type: ' . print_r($definition, true));
        }
        $type = $map[$definition['type']];
        return new $type($definition, $shapeMap);
    }
    /**
     * Get the type of the shape
     *
     * @return string
     */
    public function getType()
    {
        return $this->definition['type'];
    }
    /**
     * Get the name of the shape
     *
     * @return string
     */
    public function getName()
    {
        return $this->definition['name'];
    }
}
