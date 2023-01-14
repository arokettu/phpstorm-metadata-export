<?php

declare(strict_types=1);

namespace Arokettu\PhpStorm\Metadata\Containers\Pimple;

use Arokettu\PhpStorm\Metadata\Common\Helpers\ErrorFormatter;
use Arokettu\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use Arokettu\PhpStorm\Metadata\Containers\ContainerIterator;
use Pimple\Psr11\ServiceLocator;

final class ServiceLocatorIterator implements ContainerIterator
{
    /** @var \Pimple\Container */
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
                yield $alias => ErrorFormatter::format($exception);
            }
        }
    }
}
