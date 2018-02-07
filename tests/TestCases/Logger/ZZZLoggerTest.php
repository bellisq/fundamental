<?php

namespace Bellisq\Fundamental\Tests\TestCases\Logger;

use Bellisq\Fundamental\Logger\LogLevelConfig;
use Bellisq\Fundamental\Directory\LogDirectory;
use Bellisq\Fundamental\Logger\MonologProvider;
use Bellisq\TypeMap\TypeMapInterface;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;


class ZZZLoggerTest
    extends TestCase
{
    public function testBehavior()
    {
        /** @var TypeMapInterface $p */
        $p = new MonologProvider(new LogDirectory(__DIR__ . '/../../Logs'), new LogLevelConfig([
            'LOG_LEVEL' => LogLevel::EMERGENCY,
        ]));

        /** @var LoggerInterface $logger */
        $logger = $p->get(LoggerInterface::class);
        $this->assertInstanceOf(Logger::class, $logger);

        $logger->emergency('Logged successfully.');
    }
}