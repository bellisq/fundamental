<?php

namespace Bellisq\Fundamental\Tests\TestCases\Config;

use Bellisq\Fundamental\Exceptions\InvalidConfigException;
use Bellisq\Fundamental\Exceptions\MissingConfigException;
use Bellisq\Fundamental\Tests\Mocks\Config\ZZZSimpleConfig;
use PHPUnit\Framework\TestCase;


class ZZZConfigAbstractTest
    extends TestCase
{
    public function testMissing()
    {
        $this->expectException(MissingConfigException::class);
        new ZZZSimpleConfig([
            'KEY_BOOL' => 'On'
        ]);
    }

    public function testBool()
    {
        $this->evalBool('oN', true);
        $this->evalBool('OfF', false);
        $this->evalBool('tRuE', true);
        $this->evalBool('FALSe', false);
        $this->evalBool('1', true);
        $this->evalBool('0', false);
        $this->evalBool('3', true);
        $this->evalBool('-100', true);
    }

    public function testBoolFail()
    {
        $this->expectException(InvalidConfigException::class);
        $this->evalBool('afx', true);
    }

    private function evalBool(string $value, bool $expected)
    {
        $sc = new ZZZSimpleConfig([
            'KEY_MUST' => '29',
            'KEY_BOOL' => $value
        ]);
        $this->assertEquals($expected, $sc->boolValue);
    }
}