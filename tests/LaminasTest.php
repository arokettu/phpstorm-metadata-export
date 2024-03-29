<?php

declare(strict_types=1);

namespace Arokettu\PhpStorm\Metadata\Tests;

use Arokettu\PhpStorm\Metadata\Generator;
use Laminas\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase;

class LaminasTest extends TestCase
{
    public function testLaminas(): void
    {
        $config = [
            'services' => [
                \SplQueue::class => new \SplQueue(),
            ],
            'invokables' => [
                \SplStack::class => \SplStack::class,
            ],
            'factories' => [
                'some_generator' => function () {
                    yield 1 => 2;
                },
                'ao_not_shared' => function () {
                    return new \ArrayObject();
                },
                \stdClass::class => function () {
                    return (object)['test' => 'data'];
                },
                'errored' => function (): void {
                    throw new \RuntimeException('Unable to init');
                },
            ],
            'abstract_factories' => [], // abstract factories are not supported
            'delegators' => [
                'some_generator' => [function ($container, string $name, callable $callback) {
                    $gen = $callback();
                    return new \IteratorIterator($gen);
                }], // decorated object should be in the hint
            ],
            'aliases' => [
                'object' => \stdClass::class,
            ],
            'initializers' => [], // we don't care
            'lazy_services' => [], // lazy services are not supported
            'shared' => [
                'ao_not_shared' => false, // should not affect the result
            ]
        ];

        $sm = new ServiceManager($config);

        self::assertEquals(file_get_contents(__DIR__ . '/data/laminas.txt'), Generator::get([$sm]));
    }
}
