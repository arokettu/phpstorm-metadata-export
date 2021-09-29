<?php

declare(strict_types=1);

namespace SandFox\PhpStorm\Metadata\Containers\Pimple;

use Pimple\Psr11\Container;
use SandFox\PhpStorm\Metadata\Containers\ContainerIterator;

final class Psr11ContainerIterator implements ContainerIterator
{
    /** @var PimpleIterator */
    private $iterator;

    public function __construct(Container $container)
    {
        $pimple = (function () {
            return $this->pimple;
        })->call($container);

        $this->iterator = new PimpleIterator($pimple);
    }

    public static function getDefaultOptions(): array
    {
        return PimpleIterator::getDefaultOptions();
    }

    public function getIterator(): \Traversable
    {
        yield from $this->iterator;
    }
}
