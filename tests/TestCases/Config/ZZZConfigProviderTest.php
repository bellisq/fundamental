<?php

namespace Bellisq\Fundamental\Tests\TestCases\Config;

use Bellisq\Fundamental\Directory\RootDirectory;
use Bellisq\Fundamental\Tests\Mocks\Config\ZZZConfigProvider;
use Bellisq\Fundamental\Tests\Mocks\Config\ZZZDerivedConfig;
use PHPUnit\Framework\TestCase;


class ZZZConfigProviderTest
    extends TestCase
{
    public function testBehavior()
    {
        $cp = new ZZZConfigProvider(new RootDirectory(__DIR__ . '/../../Mocks/Config'));
        $cf = $cp->get(ZZZDerivedConfig::class);
        $this->assertEquals(29, $cf->testValue);
    }
}