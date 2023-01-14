<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

namespace Arokettu\PhpStorm\Metadata\Containers\Laminas;

use Arokettu\PhpStorm\Metadata\Common\Helpers\ErrorFormatter;
use Arokettu\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use Arokettu\PhpStorm\Metadata\Containers\ContainerIterator;

// Laminas replaces Zend so add an alias for the installed one

if (class_exists(\Laminas\ServiceManager\ServiceManager::class)) {
    class_alias(\Laminas\ServiceManager\ServiceManager::class, ServiceManager::class);
} elseif (class_exists(\Zend\ServiceManager\ServiceManager::class)) {
    class_alias(\Zend\ServiceManager\ServiceManager::class, ServiceManager::class);
}

/**
 * @internal
 */
final class ServiceManagerIterator implements ContainerIterator
{
    /** @var ServiceManager */
    private $serviceManager;

    public static function getDefaultOptions(): array
    {
        return [
            'overrides' => [
                '\\Psr\\Container\\ContainerInterface::get(0)',
                '\\Zend\\ServiceManager\\ServiceLocatorInterface::get(0)',
                '\\Laminas\\ServiceManager\\ServiceLocatorInterface::get(0)',
            ],
        ];
    }

    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @return \Traversable Iterator for all container items $key => $entry
     */
    public function getIterator(): \Traversable
    {
        $servicesFunc = function () {
            // service instances
            yield from array_keys($this->services);

            // service factories
            yield from array_keys($this->factories);

            // aliases
            yield from $this->resolvedAliases ??    // 3.5 and earlier
                $this->aliases;                     // in 3.6 aliases are pre-resolved
        };

        $services = iterator_to_array($servicesFunc->call($this->serviceManager), false);
        sort($services);

        foreach ($services as $key) {
            try {
                yield $key => TypeStrings::getTypeStringByInstance($this->serviceManager->get($key));
            } catch (\Throwable $exception) {
                yield $key => ErrorFormatter::format($exception);
            }
        }
    }
}
