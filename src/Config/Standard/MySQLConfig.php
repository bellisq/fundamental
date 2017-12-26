<?php

namespace Bellisq\Fundamental\Config\Standard;

use Bellisq\Fundamental\Config\ConfigAbstract;


/**
 * [Class] MySQL Config
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/fundamental
 * @since 1.0.0
 *
 * @property-read string $host
 * @property-read string $user
 * @property-read string $pass
 * @property-read string $database
 */
class MySQLConfig
    extends ConfigAbstract
{
    private const ENV_MYSQL_HOST = 'MYSQL_HOST';
    private const ENV_MYSQL_USER = 'MYSQL_USER';
    private const ENV_MYSQL_PASS = 'MYSQL_PASS';
    private const ENV_MYSQL_DATABASE = 'MYSQL_DATABASE';

    protected function initialize(array $env)
    {
        $this->existOrFail(self::ENV_MYSQL_HOST);
        $this->existOrFail(self::ENV_MYSQL_USER);
        $this->existOrFail(self::ENV_MYSQL_PASS);
        $this->existOrFail(self::ENV_MYSQL_DATABASE);

        $this->setReadonlyProperty('host', (string)($env[self::ENV_MYSQL_HOST]));
        $this->setReadonlyProperty('user', (string)($env[self::ENV_MYSQL_USER]));
        $this->setReadonlyProperty('pass', (string)($env[self::ENV_MYSQL_PASS]));
        $this->setReadonlyProperty('database', (string)($env[self::ENV_MYSQL_DATABASE]));
    }
}