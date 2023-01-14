<?php

declare(strict_types=1);

namespace Arokettu\PhpStorm\Metadata\Containers;

/**
 * @internal
 * @template-extends \IteratorAggregate<int, mixed>
 */
interface ContainerIterator extends \IteratorAggregate
{
    /**
     * @internal
     */
    public static function getDefaultOptions(): array;
}
