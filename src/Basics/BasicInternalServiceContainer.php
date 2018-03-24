<?php

namespace Bellisq\Fundamental\Basics;

use Bellisq\Fundamental\Directory\LogDirectory;
use Bellisq\Fundamental\Directory\RootDirectory;
use Bellisq\Fundamental\Logger\LogLevelConfigProvider;
use Bellisq\Fundamental\Logger\MonologProvider;
use Bellisq\TypeMap\DI\Container;
use Bellisq\TypeMap\DI\Transport\ProviderRegister;
use Bellisq\TypeMap\Utility\ObjectContainer;
use Psr\Log\LoggerInterface;


/**
 * [Class] Basic Internal Service Container
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 *
 * @property-read LoggerInterface $logger
 */
class BasicInternalServiceContainer
    extends Container
{
    /**
     * @inheritdoc
     */
    protected static function registerProviders(ProviderRegister $providerRegister): void
    {
        $providerRegister
            ->registerClass(LogLevelConfigProvider::class)
            ->registerClass(MonologProvider::class);
    }

    final public function __construct(RootDirectory $rd, LogDirectory $ld)
    {
        parent::__construct(new ObjectContainer($rd, $ld));
    }

    /**
     * Magic method.
     *
     * @param string $name
     * @return null|object
     */
    final public function __get(string $name)
    {
        $map = [
            'logger' => LoggerInterface::class,
        ];

        if (isset($map[$name])) {
            return $this->getObject($map[$name]);
        }
        return null;
    }
}