<?php

namespace Bellisq\Fundamental\Tests\Mocks\Config;

use Bellisq\Fundamental\Tests\Mocks\Config\ZZZBaseConfig;


/**
 * @property-read int $testValue
 */
class ZZZDerivedConfig
    extends ZZZBaseConfig
{
    protected function initialize(array $env)
    {
        parent::initialize($env);
        $this->setReadonlyProperty('testValue', (int)($env['TEST_VALUE'] ?? 0));
    }
}