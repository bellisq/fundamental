<?php

namespace Bellisq\Fundamental\Tests\TestCases\Logger;

use Bellisq\Fundamental\Logger\LogLevelConfig;
use Bellisq\Fundamental\Exceptions\InvalidConfigException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;


class ZZLogLevelConfigTest
    extends TestCase
{
    private function evalLogLevel(string $value, string $expected)
    {
        $dc = new LogLevelConfig([
            'LOG_LEVEL' => $value
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