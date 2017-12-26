<?php

namespace Bellisq\Fundamental\Tests\TestCases\Logger;

use Bellisq\Fundamental\Config\Standard\DebugConfig;
use Bellisq\Fundamental\Directory\LogDirectory;
use Bellisq\Fundamental\Logger\MonologProvider;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;


class ZZZLoggerTest
    extends TestCase
{
    public function testBehavior()
    {
        $p = new MonologProvider(new LogDirectory(__DIR__ . '/../../Logs'), new DebugConfig([
            'DEBUG_LOG_LEVEL' => LogLevel::EMERGENCY,
            'DEBUG_DEBUG_MODE' => 'true',
        ]));

        /** @var LoggerInterface $logger */
        $logger = $p->get(LoggerInterface::class);
        $this->assertInstanceOf(Logger::class, $logger);

        $logger->emergency('Logged successfully.');
    }
}