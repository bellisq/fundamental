<?php

namespace Bellisq\Fundamental\Tests\TestCases\Directory;

use Bellisq\Fundamental\Directory\LogDirectory;
use Bellisq\Fundamental\Directory\RootDirectory;
use PHPUnit\Framework\TestCase;


class ZZZDirectoryTest
    extends TestCase
{
    public function testBehavior()
    {
        $ld = new LogDirectory('test');
        $this->assertEquals('test', $ld->get());
        $this->assertEquals('test', $ld);

        $rd = new RootDirectory('test');
        $this->assertEquals('test', $rd->get());
        $this->assertEquals('test', $rd);
    }
}