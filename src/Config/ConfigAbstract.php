<?php

namespace Bellisq\Fundamental\Config;

use Strict\Property\Utility\ReadonlyPropertyContainer;


/**
 * [Abstract Class] Config
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 */
abstract class ConfigAbstract
    extends ReadonlyPropertyContainer
{
    final public function __construct(array $env)
    {
        $this->initialize($env);
    }

    abstract protected function initialize(array $env);
}