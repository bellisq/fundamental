<?php

namespace Bellisq\Fundamental\Logger;

use Bellisq\Fundamental\Config\ConfigAbstract;
use Bellisq\Fundamental\Exceptions\InvalidConfigException;
use Psr\Log\LogLevel;


/**
 * [Class] Log-Level Config
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 *
 * @property-read string $logLevel
 */
class LogLevelConfig
    extends ConfigAbstract
{
    private const ENV_LOG_LEVEL = 'LOG_LEVEL';

    public const DEF_LOG_LEVEL = LogLevel::NOTICE;

    protected function initialize(array $env)
    {
        $this->setReadonlyProperty('logLevel', $this->getLogLevel($env));
    }

    private function getLogLevel(array $env): string
    {
        if (!isset($env[self::ENV_LOG_LEVEL]) or !is_string($env[self::ENV_LOG_LEVEL])) {
            return self::DEF_LOG_LEVEL;
        }

        $t = strtolower(trim($env[self::ENV_LOG_LEVEL]));
        $allowed = [
            LogLevel::EMERGENCY => true,
            LogLevel::ALERT     => true,
            LogLevel::CRITICAL  => true,
            LogLevel::ERROR     => true,
            LogLevel::WARNING   => true,
            LogLevel::NOTICE    => true,
            LogLevel::INFO      => true,
            LogLevel::DEBUG     => true,
        ];

        if (isset($allowed[$t])) {
            return $t;
        }

        throw new InvalidConfigException(self::ENV_LOG_LEVEL, static::class);
    }
}