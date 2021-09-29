<?php

declare(strict_types=1);

namespace SandFox\PhpStorm\Metadata\Containers\StaticMap;

use SandFox\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use SandFox\PhpStorm\Metadata\Containers\ContainerIterator;
use SandFox\PhpStorm\Metadata\StaticMap;

/**
 * @internal
 */
final class StaticMapIterator implements ContainerIterator
{
    /**
     * @var StaticMap
     */
    private $map;

    public static function getDefaultOptions(): array
    {
        return [];
    }

    public function __construct(StaticMap $map)
    {
        $this->map = $map;
    }

    public function getIterator(): \Traversable
    {
        foreach ($this->map as $key => $value) {
            yield $key => TypeStrings::getTypeStringByTypeName($value);
        }
    }
}
