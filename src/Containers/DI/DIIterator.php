<?php

declare(strict_types=1);

namespace SandFox\PhpStorm\Metadata\Containers\DI;

use DI\Container;
use SandFox\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use SandFox\PhpStorm\Metadata\Containers\ContainerIterator;
use Throwable;
use Traversable;

final class DIIterator implements ContainerIterator
{
    /**
     * @var Container
     */
    private $di;

    public static function getDefaultOptions(): array
    {
        return [
            'overrides' => [
                '\\Psr\\Container\\ContainerInterface::get(0)',
                '\\DI\\Container',
            ],
        ];
    }

    public function __construct(Container $di)
    {
        $this->di = $di;
    }

    /**
     * @return Traversable Iterator for all container items $key => $entry
     */
    public function getIterator(): Traversable
    {
        $keys = $this->di->getKnownEntryNames();

        foreach ($keys as $key) {
            try {
                yield $key => TypeStrings::getTypeStringByInstance($this->di->get($key));
            } catch (Throwable $exception) {
                yield $key => TypeStrings::getTypeStringByInstance($exception) .
                    ' /* Error message: "' . $exception->getMessage() . '" */';
            }
        }
    }
}
