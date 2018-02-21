<?php


namespace SandFoxMe\PhpStorm\Metadata\Containers\StaticMap;

use SandFoxMe\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use SandFoxMe\PhpStorm\Metadata\Containers\ContainerIterator;
use SandFoxMe\PhpStorm\Metadata\StaticMap;

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
