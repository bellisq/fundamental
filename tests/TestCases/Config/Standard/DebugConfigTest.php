<?php

namespace Bellisq\Fundamental\Tests\TestCases\Config\Standard;

use Bellisq\Fundamental\Config\Standard\DebugConfig;
use Bellisq\Fundamental\Exceptions\InvalidConfigException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;


class DebugConfigTest
    extends TestCase
{
    private function evalLogLevel(string $value, string $expected)
    {
        $dc = new DebugConfig([
            'DEBUG_LOG_LEVEL' => $value
        ]);

        $this->assertEquals($expected, $dc->logLevel);
    }

    public function testLogLevel()
    {
        $this->evalLogLevel('emergency', LogLevel::EMERGENCY);
        $this->evalLogLevel(' eMeRGency  ', LogLevel::EMERGENCY);

        $this->expectException(InvalidConfigException::class);
        $this->evalLogLevel('32weds', LogLevel::EMERGENCY);
    }
}