<?php

namespace Bellisq\Fundamental\Logger;

use Bellisq\Fundamental\Config\ConfigProviderAbstract;
use Bellisq\Fundamental\Config\Transport\ConfigRegister;


class LogLevelConfigProvider
    extends ConfigProviderAbstract
{
    /**
     * Register classes using ConfigRegister
     *
     * @param ConfigRegister $configRegister
     */
    protected static function registerConfigs(ConfigRegister $configRegister): void
    {
        $configRegister
            ->register(LogLevelConfig::class);
    }
}