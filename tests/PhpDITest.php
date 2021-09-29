<?php

declare(strict_types=1);

namespace SandFox\PhpStorm\Metadata\Tests;

use DI\Container;
use PHPUnit\Framework\TestCase;
use SandFox\PhpStorm\Metadata\Generator;

use function DI\create;
use function DI\value;

class PhpDITest extends TestCase
{
    public function testPimple(): void
    {
        $di = new Container();

        $di->set(\ArrayObject::class, create());
        $di->set('string', function () {
            return 'path';
        });
        $di->set('int', value(123));
        $di->set('errored', function (): void {
            throw new \RuntimeException('Unable to init');
        });

        self::assertEquals(file_get_contents(__DIR__ . '/data/di.txt'), Generator::get([$di]));
    }
}
