<?php

namespace Bellisq\Fundamental\Exceptions;

use RuntimeException;


/**
 * [Exception] Missing Config Exception
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 */
class MissingConfigException
    extends RuntimeException
{
    public function __construct(string $directive, string $class)
    {
        parent::__construct("Missing config: '{$directive}' (required by {$class})");
    }
}