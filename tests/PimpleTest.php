<?php

declare(strict_types=1);

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

        $pimple[\ArrayObject::class] = function () {
            return new \ArrayObject();
        };
        $pimple['string'] = function () {
            return 'path';
        };
        $pimple['int'] = 123;
        $pimple['errored'] = function (): void {
            throw new \RuntimeException('Unable to init');
        };

        self::assertEquals(file_get_contents(__DIR__ . '/data/pimple.txt'), Generator::get([$pimple]));

        if (class_exists(Psr11::class)) {
            $psr11  = new Psr11($pimple);
            self::assertEquals(file_get_contents(__DIR__ . '/data/pimple.txt'), Generator::get([$psr11]));
        }

        if (class_exists(ServiceLocator::class)) {
            $sl = new ServiceLocator($pimple, $pimple->keys());
            self::assertEquals(file_get_contents(__DIR__ . '/data/pimple.txt'), Generator::get([$sl]));
        }
    }
}
