<?php

namespace Bellisq\Fundamental\Logger;

use Bellisq\Fundamental\Config\Standard\DebugConfig;
use Bellisq\Fundamental\Directory\LogDirectory;
use Bellisq\TypeMap\DI\Provider;
use Bellisq\TypeMap\DI\Transport\TypeRegister;
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;


/**
 * [Class] Monolog Provider
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 */
class MonologProvider
    extends Provider
{
    /** @var string */
    private $logDir;

    /** @var bool */
    private $isDebug;

    /** @var string */
    private $logLevel;

    public function __construct(LogDirectory $logDirectory, DebugConfig $debugConfig)
    {
        parent::__construct();

        $this->logDir = $logDirectory->get();
        $this->isDebug = $debugConfig->debugMode;
        $this->logLevel = $debugConfig->logLevel;
    }

    protected static function registerTypes(TypeRegister $typeRegister): void
    {
        $typeRegister
            ->registerAsSingleton(LoggerInterface::class);
    }

    protected function instantiateObject(string $type): object
    {
        $logger = new Logger('BellisqLogger@' . self::makeRandStr());
        if ($this->isDebug) {
            $handler = new RotatingFileHandler($this->logDir . '/monolog.log', 0, LogLevel::DEBUG);
        } else {
            $handler = new FingersCrossedHandler(
                new RotatingFileHandler($this->logDir . '/monolog.log', 0, LogLevel::INFO),
                new ErrorLevelActivationStrategy(
                    $this->logLevel)
            );
        }
        $logger->pushHandler($handler);
        return $logger;
    }

    private static function makeRandStr(): string
    {
        static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
        $length = 8;
        $str = '';
        for ($i = 0; $i < $length; ++$i) {
            $str .= $chars[mt_rand(0, 61)];
        }
        return $str;
    }
}