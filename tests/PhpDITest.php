<?php

declare(strict_types=1);

namespace SandFox\PhpStorm\Metadata\Tests;

use DI\Container;
use PHPUnit\Framework\TestCase;
use SandFox\PhpStorm\Metadata\Generator;

use function DI\create;

class PhpDITest extends TestCase
{
    public function testPimple(): void
    {
        $di = new Container();

        $di->set(\ArrayObject::class, create()->constructor([], 0, \ArrayIterator::class));
        $di->set('string', function () {
            return 'path';
        });
        $di->set('int', function () {
            return 123;
        });
        $di->set('errored', function (): void {
            throw new \RuntimeException('Unable to init');
        });

        self::assertEquals(file_get_contents(__DIR__ . '/data/di.txt'), Generator::get([$di]));
    }
}
