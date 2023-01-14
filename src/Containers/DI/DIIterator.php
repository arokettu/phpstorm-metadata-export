<?php

declare(strict_types=1);

namespace Arokettu\PhpStorm\Metadata\Containers\DI;

use Arokettu\PhpStorm\Metadata\Common\Helpers\ErrorFormatter;
use Arokettu\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use Arokettu\PhpStorm\Metadata\Containers\ContainerIterator;
use DI\Container;
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
                yield $key => ErrorFormatter::format($exception);
            }
        }
    }
}
