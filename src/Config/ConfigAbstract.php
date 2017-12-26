<?php

namespace Bellisq\Fundamental\Config;

use Bellisq\Fundamental\Exceptions\InvalidConfigException;
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

    /**
     * ConfigAbstract constructor.
     *
     * @param array $env
     */
    final public function __construct(array $env)
    {
        $this->env = $env;
        $this->initialize($env);
    }

    abstract protected function initialize(array $env);

    /**
     * Check if a specific env variable is set or not.
     * If it isn't set, throw an exception.
     *
     * @param string $key
     *
     * @throws MissingConfigException
     */
    final protected function existOrFail(string $key): void
    {
        if (!isset($this->env[$key])) {
            throw new MissingConfigException($key, static::class);
        }
    }

    /**
     * Get bool value from env variables.
     *
     * @param string $key
     * @param bool $default
     * @return bool
     */
    final protected function getBool(string $key, bool $default = false): bool
    {
        if (!isset($this->env[$key]) or !is_string($this->env[$key])) {
            return $default;
        }

        $t = strtolower(trim($this->env[$key]));

        $allowed = [
            'true' => true,
            'on' => true,
            '1' => true,
            'false' => false,
            'off' => false,
            '0' => false,
        ];
        if (isset($allowed[$t])) {
            return $allowed[$t];
        }

        if (is_numeric($t)) {
            // if $t == 0, false is already returned.
            return true;
        }

        throw new InvalidConfigException($key, static::class);
    }
}