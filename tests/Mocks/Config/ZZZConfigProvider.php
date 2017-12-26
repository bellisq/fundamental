<?php

namespace Bellisq\Fundamental\Tests\Mocks\Config;

use Bellisq\Fundamental\Config\ConfigProviderAbstract;
use Bellisq\Fundamental\Config\Transport\ConfigRegister;


class ZZZConfigProvider
    extends ConfigProviderAbstract
{
    protected static function registerConfigs(ConfigRegister $configRegister): void
    {
        $configRegister
            ->register(ZZZDerivedConfig::class);
    }
}