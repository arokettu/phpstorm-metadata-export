<?php

namespace SandFoxMe\PhpStorm\Metadata;

use Pimple\Container as Pimple;
use SandFoxMe\PhpStorm\Metadata\Common\Metadata;
use SandFoxMe\PhpStorm\Metadata\Containers\Pimple\PimpleIterator;
use SandFoxMe\PhpStorm\Metadata\Containers\StaticMap\StaticMapIterator;
use SandFoxMe\PhpStorm\Metadata\Containers\Zend\ServiceManagerIterator;
use Zend\ServiceManager\ServiceManager;

abstract class Generator
{
    public static function get(array $containers, array $options = [])
    {
        if (count($containers) === 0) {
            throw new \RuntimeException('$containers must contain at least one container');
        }

        $options = self::applyDefaults($containers[0], $options);

        $iterators = array_map(function ($container) {
            $iteratorClass = self::getIteratorClass($container);
            return new $iteratorClass($container);
        }, $containers);

        $tmpAutoload = function ($className) {
            throw new \RuntimeException('Metadata Export fallback autoloader: Cannot load class ' . $className);
        };

        try {
            spl_autoload_register($tmpAutoload); // so non existing class is not a fatal error but an exception
            $metadata = new Metadata(...$iterators);
            return $metadata->render($options['overrides']);
        } finally {
            spl_autoload_unregister($tmpAutoload);
        }
    }

    /**
     * @param string    $filename   path to store map (absolute realpath if possible)
     * @param array     $containers array of containers to store
     * @param array     $options    options
     * @return bool
     */
    public static function store(string $filename, array $containers, array $options = []): bool
    {
        $dirname = dirname($filename);

        if (!file_exists($dirname)) {
            $result = mkdir($dirname, 0777, true);

            if ($result === false) {
                return false;
            }
        }

        if (!is_dir($dirname)) {
            return false;
        }

        $result = file_put_contents($filename, self::get($containers, $options));

        return $result !== false;
    }

    private static function applyDefaults($container, $options): array
    {
        if ($container instanceof StaticMap) {
            throw new \RuntimeException('StaticMap should not be the first supplied container');
        }

        $iteratorClass = self::getIteratorClass($container);

        return array_merge($iteratorClass::DEFAULT_OPTIONS, $options);
    }

    private static function getIteratorClass($container): string
    {
        if ($container instanceof StaticMap) {
            return StaticMapIterator::class;
        }

        if ($container instanceof Pimple) {
            return PimpleIterator::class;
        }

        if ($container instanceof ServiceManager) {
            return ServiceManagerIterator::class;
        }

        throw new \RuntimeException('Unsupported container');
    }
}
