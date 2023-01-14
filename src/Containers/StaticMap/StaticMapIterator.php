<?php

declare(strict_types=1);

namespace Arokettu\PhpStorm\Metadata\Containers\StaticMap;

use Arokettu\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use Arokettu\PhpStorm\Metadata\Containers\ContainerIterator;
use Arokettu\PhpStorm\Metadata\StaticMap;

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
