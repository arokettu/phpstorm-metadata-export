<?php

namespace SandFox\PhpStorm\Metadata\Containers\StaticMap;

use SandFox\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use SandFox\PhpStorm\Metadata\Containers\ContainerIterator;
use SandFox\PhpStorm\Metadata\StaticMap;

/**
 * @internal
 */
class StaticMapIterator implements ContainerIterator
{
    private $map;

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
