<?php

namespace Bellisq\Fundamental\Directory;


/**
 * [Abstract Class] Directory
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 */
abstract class DirectoryAbstract
{
    /** @var string */
    private $dir;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    public function __toString(): string
    {
        return $this->get();
    }

    public function get(): string
    {
        return $this->dir;
    }
}