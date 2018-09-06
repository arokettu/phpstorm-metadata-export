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
        $keysFunc = function () {
            $keys = array_unique(array_merge(
                array_keys($this->aliases),
                array_keys($this->services),
                array_keys($this->factories)
            ));

            return $keys;
        };

        $keys = ($keysFunc->bindTo($this->serviceManager, $this->serviceManager))();

        foreach ($keys as $key) {
            try {
                yield $key => TypeStrings::getTypeStringByInstance($this->serviceManager->get($key));
            } catch (\Throwable $exception) {
                yield $key => TypeStrings::getTypeStringByInstance($exception) .
                    ' /* Error message: "' . $exception->getMessage() . '" */';
            }
        }
    }
}
