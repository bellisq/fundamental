<?php

namespace Bellisq\Fundamental\Config\Transport;

use Bellisq\Fundamental\Config\Storage\ConfigDefinition;


/**
 * [Class] Config Register
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 */
class ConfigRegister
{
    /** @var ConfigDefinition */
    private $configDefinition;

    /**
     * ConfigRegister constructor.
     *
     * @param ConfigDefinition $configDefinition
     */
    public function __construct(ConfigDefinition $configDefinition)
    {
        $this->configDefinition = $configDefinition;
    }

    /**
     * @param string $realClassName
     * @param null|string $virtualClassName
     * @return ConfigRegister
     */
    public function register(string $realClassName, ?string $virtualClassName = null): self
    {
        $this->configDefinition->add($realClassName, $virtualClassName ?? $realClassName);
        return $this;
    }
}