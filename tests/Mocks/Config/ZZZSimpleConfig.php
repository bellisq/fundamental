<?php

namespace Bellisq\Fundamental\Tests\Mocks\Config;

use Bellisq\Fundamental\Config\ConfigAbstract;


/**
 * @property-read bool $boolValue
 */
class ZZZSimpleConfig
    extends ConfigAbstract
{
    protected function initialize(array $env)
    {
        $this->existOrFail('KEY_MUST');
        $this->setReadonlyProperty('boolValue', $this->getBool('KEY_BOOL'));
    }
}