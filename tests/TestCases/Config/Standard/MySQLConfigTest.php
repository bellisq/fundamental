<?php

namespace Bellisq\Fundamental\Tests\TestCases\Config\Standard;

use Bellisq\Fundamental\Config\Standard\MySQLConfig;
use Bellisq\Fundamental\Exceptions\MissingConfigException;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;


class MySQLConfigTest
    extends TestCase
{
    public function testComplete()
    {

        $oldEnv = $_ENV;
        $oldSvr = $_SERVER;

        $_ENV = [];

        (new Dotenv(__DIR__ . '/../../../Envs/MySQLTest/Complete'))->load();

        $result = $_ENV;

        $_ENV = $oldEnv;
        $_SERVER = $oldSvr;

        $mc = new MySQLConfig($result);
        $this->assertEquals('127.0.0.1', $mc->host);
        $this->assertEquals('root', $mc->user);
        $this->assertEquals('password', $mc->pass);
        $this->assertEquals('database', $mc->database);
    }

    public function testLack()
    {

        $oldEnv = $_ENV;
        $oldSvr = $_SERVER;

        $_ENV = [];

        (new Dotenv(__DIR__ . '/../../../Envs/MySQLTest/Lack'))->load();

        $result = $_ENV;

        $_ENV = $oldEnv;
        $_SERVER = $oldSvr;

        $this->expectException(MissingConfigException::class);
        new MySQLConfig($result);
    }
}