<?php

namespace Bellisq\Fundamental\Config\Storage;

use Bellisq\Fundamental\Config\ConfigAbstract;
use Bellisq\Fundamental\Exceptions\InheritanceViolationException;
use Bellisq\Fundamental\Exceptions\UnqualifiedVirtualClassNameException;
use Bellisq\Fundamental\Exceptions\VirtualClassConflictionException;


/**
 * [Class] Config Definition
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 */
class ConfigDefinition
{
    /** @var string[] */
    private $virtualMap = [];

    /**
     * @param string $real
     * @param string $virtual
     */
    public function add(string $real, string $virtual): void
    {
        if (!is_subclass_of($virtual, ConfigAbstract::class, true)) {
            throw new UnqualifiedVirtualClassNameException;
        }
        if (!is_a($real, $virtual, true)) {
            throw new InheritanceViolationException;
        }

        if (isset($this->virtualMap[$virtual])) {
            throw new VirtualClassConflictionException;
        }
        $this->virtualMap[$virtual] = $real;
    }

    /**
     * @return string[]
     */
    public function getVirtualList(): array
    {
        return array_keys($this->virtualMap);
    }

    /**
     * Only `ConfigProviderAbstract` can call this function.
     * So, `ConfigProviderAbstract` is responsible for the assertion.
     *
     * @param string $virtual
     * @return string
     */
    public function getRealClassName(string $virtual): string
    {
        assert(isset($this->virtualMap[$virtual]));
        return $this->virtualMap[$virtual];
    }
}