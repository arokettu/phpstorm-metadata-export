<?php

namespace SandFox\PhpStorm\Metadata\Containers\Zend;

use SandFox\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use SandFox\PhpStorm\Metadata\Containers\ContainerIterator;

// Laminas replaces Zend so add an alias for the installed one

if (class_exists(\Laminas\ServiceManager\ServiceManager::class)) {
    class_alias(\Laminas\ServiceManager\ServiceManager::class, ServiceManager::class);
} elseif (class_exists(\Zend\ServiceManager\ServiceManager::class)) {
    class_alias(\Zend\ServiceManager\ServiceManager::class, ServiceManager::class);
}

/**
 * @internal
 */
class ServiceManagerIterator implements ContainerIterator
{
    const DEFAULT_OPTIONS = [
        'overrides' => [
            '\\Psr\\Container\\ContainerInterface::get(0)',
            '\\Zend\\ServiceManager\\ServiceLocatorInterface::get(0)',
            '\\Laminas\\ServiceManager\\ServiceLocatorInterface::get(0)',
        ],
    ];

    private $serviceManager;

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
            $services = [];

            foreach ($this->resolvedAliases as $key => $class) {
                $services[$key]     = $class;
                $services[$class]   = $class;
            }

            foreach ($this->factories as $factoryKey => $factory) {
                $services[$factoryKey] = $factoryKey;
            }

            ksort($services);

            return $services;
        };

        $services = ($servicesFunc->bindTo($this->serviceManager, ServiceManager::class))();

        foreach ($services as $key => $class) {
            yield $key => TypeStrings::getTypeStringByTypeName($class);
        }
    }
}
