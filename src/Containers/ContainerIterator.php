<?php

namespace SandFox\PhpStorm\Metadata\Containers;

/**
 * @internal
 */
interface ContainerIterator extends \IteratorAggregate
{
    /**
     * @internal
     */
    public static function getDefaultOptions(): array;
}
