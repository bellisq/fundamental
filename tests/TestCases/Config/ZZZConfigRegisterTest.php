<?php

namespace Bellisq\Fundamental\Tests\TestCases\Config;

use Bellisq\Fundamental\Config\Storage\ConfigDefinition;
use Bellisq\Fundamental\Config\Transport\ConfigRegister;
use Bellisq\Fundamental\Exceptions\InheritanceViolationException;
use Bellisq\Fundamental\Exceptions\UnqualifiedVirtualClassNameException;
use Bellisq\Fundamental\Exceptions\VirtualClassConflictionException;
use Bellisq\Fundamental\Tests\Mocks\Config\ZZZBaseConfig;
use Bellisq\Fundamental\Tests\Mocks\Config\ZZZDerivedConfig;
use PHPUnit\Framework\TestCase;


class ZZZConfigRegisterTest
    extends TestCase
{
    /** @var ConfigDefinition */
    private $definition;

    /** @var ConfigRegister */
    private $register;

    public function setUp()
    {
        $this->register = new ConfigRegister(
            $this->definition = new ConfigDefinition
        );
    }

    public function testBehavior1()
    {
        $this->register->register(ZZZDerivedConfig::class);

        $this->assertEquals(
            ZZZDerivedConfig::class,
            $this->definition->getRealClassName(ZZZDerivedConfig::class)
        );
        $this->assertEquals([
            ZZZDerivedConfig::class
        ], $this->definition->getVirtualList());
    }

    public function testBehavior2()
    {
        $this->register->register(
            ZZZDerivedConfig::class,
            ZZZBaseConfig::class
        );

        $this->assertEquals(
            ZZZDerivedConfig::class,
            $this->definition->getRealClassName(ZZZBaseConfig::class)
        );
        $this->assertEquals([
            ZZZBaseConfig::class
        ], $this->definition->getVirtualList());
    }

    public function testUnqualified()
    {
        $this->expectException(UnqualifiedVirtualClassNameException::class);
        $this->register->register(self::class);
    }

    public function testInheritanceViolation()
    {
        $this->expectException(InheritanceViolationException::class);
        $this->register->register(ZZZBaseConfig::class, ZZZDerivedConfig::class);
    }

    public function testVirtualClassConfliction()
    {
        $this->expectException(VirtualClassConflictionException::class);
        $this->register->register(ZZZBaseConfig::class);
        $this->register->register(ZZZBaseConfig::class);
    }
}