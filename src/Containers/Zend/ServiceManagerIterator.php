<?php

namespace SandFoxMe\PhpStorm\Metadata\Containers\Zend;

use SandFoxMe\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use SandFoxMe\PhpStorm\Metadata\Containers\ContainerIterator;
use Zend\ServiceManager\ServiceManager;

class ServiceManagerIterator implements ContainerIterator
{
    const DEFAULT_OPTIONS = [
        'overrides' => [
            '\\Psr\\Container\\ContainerInterface::get(0)',
            '\\Zend\\ServiceManager\\ServiceLocatorInterface::get(0)',
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

            foreach ($this->factories as $factory) {
                $services[$factory] = $factory;
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
