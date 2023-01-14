<?php

declare(strict_types=1);

namespace Arokettu\PhpStorm\Metadata\Containers\Pimple;

use Arokettu\PhpStorm\Metadata\Common\Helpers\ErrorFormatter;
use Arokettu\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use Arokettu\PhpStorm\Metadata\Containers\ContainerIterator;
use Pimple\Container;

/**
 * @internal
 */
final class PimpleIterator implements ContainerIterator
{
    /**
     * @var Container
     */
    private $pimple;

    public static function getDefaultOptions(): array
    {
        return [
            'overrides' => [
                '\\Psr\\Container\\ContainerInterface::get(0)',
                'new \\Pimple\\Container',
            ],
        ];
    }

    public function __construct(Container $pimple)
    {
        $this->pimple = $pimple;
    }

    /**
     * @return \Traversable Iterator for all container items $key => $entry
     */
    public function getIterator(): \Traversable
    {
        $keys = $this->pimple->keys();

        sort($keys);

        foreach ($keys as $key) {
            try {
                yield $key => TypeStrings::getTypeStringByInstance($this->pimple[$key]);
            } catch (\Throwable $exception) {
                yield $key => ErrorFormatter::format($exception);
            }
        }
    }
}
