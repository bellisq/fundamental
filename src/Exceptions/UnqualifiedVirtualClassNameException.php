<?php

namespace Bellisq\Fundamental\Exceptions;

use LogicException;


/**
 * [Exception] Unqualified Virtual Class Name Exception
 *
 * A virtual class must be a subclass of `ConfigAbstract`.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 */
class UnqualifiedVirtualClassNameException
    extends LogicException
{

}