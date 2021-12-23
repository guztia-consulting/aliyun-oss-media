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
namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Handler\SyslogUdp;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Utils;
class UdpSocket
{
    protected const DATAGRAM_MAX_LENGTH = 65023;
    /** @var string */
    protected $ip;
    /** @var int */
    protected $port;
    /** @var resource|null */
    protected $socket;
    public function __construct(string $ip, int $port = 514)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    }
    public function write($line, $header = "")
    {
        $this->send($this->assembleMessage($line, $header));
    }
    public function close() : void
    {
        if (is_resource($this->socket)) {
            socket_close($this->socket);
            $this->socket = null;
        }
    }
    protected function send(string $chunk) : void
    {
        if (!is_resource($this->socket)) {
            throw new \RuntimeException('The UdpSocket to ' . $this->ip . ':' . $this->port . ' has been closed and can not be written to anymore');
        }
        socket_sendto($this->socket, $chunk, strlen($chunk), $flags = 0, $this->ip, $this->port);
    }
    protected function assembleMessage(string $line, string $header) : string
    {
        $chunkSize = static::DATAGRAM_MAX_LENGTH - strlen($header);
        return $header . \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Utils::substr($line, 0, $chunkSize);
    }
}
