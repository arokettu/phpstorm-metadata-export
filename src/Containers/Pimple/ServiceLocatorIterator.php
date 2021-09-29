<?php

namespace SandFox\PhpStorm\Metadata\Containers\Pimple;

use Pimple\Container;
use Pimple\Psr11\ServiceLocator;
use SandFox\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use SandFox\PhpStorm\Metadata\Containers\ContainerIterator;

class ServiceLocatorIterator implements ContainerIterator
{
    /** @var Container */
    private $pimple;
    /** @var array */
    private $aliases;

    public function __construct(ServiceLocator $serviceLocator)
    {
        [$this->pimple, $this->aliases] = (function () {
            return [$this->container, $this->aliases];
        })->call($serviceLocator);

        sort($this->aliases);
    }

    public static function getDefaultOptions(): array
    {
        return PimpleIterator::getDefaultOptions();
    }

    public function getIterator(): \Traversable
    {
        foreach ($this->aliases as $alias) {
            try {
                yield $alias => TypeStrings::getTypeStringByInstance($this->pimple[$alias]);
            } catch (\Throwable $exception) {
                yield $alias => TypeStrings::getTypeStringByInstance($exception) .
                    ' /* Error message: "' . $exception->getMessage() . '" */';
            }
        }
    }
}
