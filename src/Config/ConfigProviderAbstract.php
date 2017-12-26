<?php

namespace Bellisq\Fundamental\Config;

use Bellisq\Fundamental\Config\ConfigAbstract;
use Bellisq\Fundamental\Config\Storage\ConfigDefinition;
use Bellisq\Fundamental\Config\Transport\ConfigRegister;
use Bellisq\Fundamental\Directory\RootDirectory;
use Bellisq\TypeMap\DI\Provider;
use Bellisq\TypeMap\DI\Transport\TypeRegister;
use Dotenv\Dotenv;


/**
 * [Abstract Class] Config Provider
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 */
abstract class ConfigProviderAbstract
    extends Provider
{
    /** @var array */
    private $result;

    /** @var ConfigDefinition */
    private $definition;

    /**
     * ConfigProviderAbstract constructor.
     *
     * @param RootDirectory $rootDirectory
     */
    final public function __construct(RootDirectory $rootDirectory)
    {
        $oldEnv = $_ENV;
        $oldSvr = $_SERVER;

        $_ENV = [];

        (new Dotenv($rootDirectory->get()))->load();

        $this->result = $_ENV;

        $_ENV = $oldEnv;
        $_SERVER = $oldSvr;

        parent::__construct();

        $this->definition = self::$definitions[static::class];
    }

    /**
     * @inheritdoc
     */
    final protected function instantiateObject(string $type): object
    {
        $className = $this->definition->getRealClassName($type);
        return new $className($this->result);
    }

    /**
     * @inheritdoc
     */
    final protected static function registerTypes(TypeRegister $typeRegister): void
    {
        $definition = new ConfigDefinition;
        static::registerConfigs(new ConfigRegister($definition));

        self::$definitions[static::class] = $definition;

        foreach ($definition->getVirtualList() as $class) {
            $typeRegister->registerAsSingleton($class);
        }
    }

    /** @var ConfigDefinition[] */
    private static $definitions = [];

    /**
     * Register classes using ConfigRegister
     *
     * @param ConfigRegister $configRegister
     */
    abstract protected static function registerConfigs(ConfigRegister $configRegister): void;
}