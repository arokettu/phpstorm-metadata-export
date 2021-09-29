<?php

namespace SandFox\PhpStorm\Metadata\Tests;

use PHPUnit\Framework\TestCase;
use Pimple\Container as Pimple;
use Pimple\Psr11\Container as Psr11;
use Pimple\Psr11\ServiceLocator;
use SandFox\PhpStorm\Metadata\Generator;

class PimpleTest extends TestCase
{
    public function testPimple(): void
    {
        $pimple = new Pimple();
        $psr11  = new Psr11($pimple);

        $pimple[\ArrayObject::class] = function () {
            return new \ArrayObject();
        };
        $pimple['string'] = function () {
            return 'path';
        };
        $pimple['int'] = 123;

        $sl = new ServiceLocator($pimple, $pimple->keys());

        self::assertEquals(file_get_contents(__DIR__ . '/data/pimple.txt'), Generator::get([$pimple]));
        self::assertEquals(file_get_contents(__DIR__ . '/data/pimple.txt'), Generator::get([$psr11]));
        self::assertEquals(file_get_contents(__DIR__ . '/data/pimple.txt'), Generator::get([$sl]));
    }
}