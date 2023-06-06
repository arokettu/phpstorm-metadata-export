<?php

declare(strict_types=1);

namespace Arokettu\PhpStorm\Metadata\Common;

use Arokettu\PhpStorm\Metadata\Containers\ContainerIterator;

/**
 * @internal
 * @see https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata
 */
final class Metadata
{
    /**
     * @var ContainerIterator[]
     */
    private $iterators;

    public function __construct(ContainerIterator ...$containerIterators)
    {
        $this->iterators = $containerIterators;
    }

    public function render(array $containerMethods): string
    {
        // Always add ['Typename'] => Typename::class mapping
        $map = ['' => "'@'"];

        $map = array_merge($map, ...array_map(function ($iterator) {
            return $this->createMap($iterator);
        }, $this->iterators));

        $mapStrings = [];

        foreach ($map as $key => $value) {
            $key = str_replace('\\', '\\\\', $key);
            $key = str_replace('\'', '\\\'', $key);
            $mapStrings[] = "'{$key}' => {$value},";
        }

        $mapString = implode("\n        ", $mapStrings);

        $generatorClass = self::class;

        $metadata = <<<PHP
<?php

// This file is automatically generated by {$generatorClass}

namespace PHPSTORM_META {
PHP;

        foreach ($containerMethods as $method) {
            $metadata .= "\n    override({$method}, map([\n        {$mapString}\n    ]));";
        }

        $metadata .= "\n}\n";

        return $metadata;
    }

    private function createMap(ContainerIterator $exportIterator): array
    {
        $map = [];

        foreach ($exportIterator as $key => $value) {
            $map[$key] = $value;
        }

        return $map;
    }
}
