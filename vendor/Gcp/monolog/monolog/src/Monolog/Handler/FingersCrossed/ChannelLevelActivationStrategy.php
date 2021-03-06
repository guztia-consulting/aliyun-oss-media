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
namespace GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Handler\FingersCrossed;

use GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger;
/**
 * Channel and Error level based monolog activation strategy. Allows to trigger activation
 * based on level per channel. e.g. trigger activation on level 'ERROR' by default, except
 * for records of the 'sql' channel; those should trigger activation on level 'WARN'.
 *
 * Example:
 *
 * <code>
 *   $activationStrategy = new ChannelLevelActivationStrategy(
 *       Logger::CRITICAL,
 *       array(
 *           'request' => Logger::ALERT,
 *           'sensitive' => Logger::ERROR,
 *       )
 *   );
 *   $handler = new FingersCrossedHandler(new StreamHandler('php://stderr'), $activationStrategy);
 * </code>
 *
 * @author Mike Meessen <netmikey@gmail.com>
 */
class ChannelLevelActivationStrategy implements \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Handler\FingersCrossed\ActivationStrategyInterface
{
    /**
     * @var int
     */
    private $defaultActionLevel;
    /**
     * @var array
     */
    private $channelToActionLevel;
    /**
     * @param int|string $defaultActionLevel   The default action level to be used if the record's category doesn't match any
     * @param array      $channelToActionLevel An array that maps channel names to action levels.
     */
    public function __construct($defaultActionLevel, array $channelToActionLevel = [])
    {
        $this->defaultActionLevel = \GuztiaConsulting\Aliyun_OSS_Media\Gcp\Monolog\Logger::toMonologLevel($defaultActionLevel);
        $this->channelToActionLevel = array_map('GuztiaConsulting\\Aliyun_OSS_Media\\Gcp\\Monolog\\Logger::toMonologLevel', $channelToActionLevel);
    }
    public function isHandlerActivated(array $record) : bool
    {
        if (isset($this->channelToActionLevel[$record['channel']])) {
            return $record['level'] >= $this->channelToActionLevel[$record['channel']];
        }
        return $record['level'] >= $this->defaultActionLevel;
    }
}
