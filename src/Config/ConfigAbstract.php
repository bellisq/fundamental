<?php

namespace Bellisq\Fundamental\Config;

use Bellisq\Fundamental\Exceptions\MissingConfigException;
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
    /** @var array */
    private $env;

    final public function __construct(array $env)
    {
        $this->env = $env;
        $this->initialize($env);
    }

    abstract protected function initialize(array $env);

    protected function existOrFail(string $key): void
    {
        if (!isset($this->env[$key])) {
            throw new MissingConfigException($key, static::class);
        }
    }
}