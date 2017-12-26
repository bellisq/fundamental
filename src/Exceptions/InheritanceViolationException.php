<?php

namespace Bellisq\Fundamental\Exceptions;

use LogicException;


/**
 * [Exception] Inheritance Violation Exception
 *
 * A real class must be a subclass of the virtual class.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 */
class InheritanceViolationException
    extends LogicException
{

}