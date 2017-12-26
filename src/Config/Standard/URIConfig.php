<?php

namespace Bellisq\Fundamental\Config\Standard;

use Bellisq\Fundamental\Config\ConfigAbstract;


/**
 * [Class] URI Config
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 *
 * @property-read string $hostName
 * @property-read string $protocol
 */
class URIConfig
    extends ConfigAbstract
{
    private const ENV_HOST_NAME = 'URL_HOST_NAME';
    private const ENV_PROTOCOL = 'URL_PROTOCOL';

    protected function initialize(array $env)
    {
        $this->existOrFail(self::ENV_HOST_NAME);
        $this->existOrFail(self::ENV_PROTOCOL);

        $this->setReadonlyProperty('hostName', (string)$env[self::ENV_HOST_NAME]);
        $this->setReadonlyProperty('protocol', (string)$env[self::ENV_PROTOCOL]);
    }

}