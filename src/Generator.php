<?php

declare(strict_types=1);

namespace Arokettu\PhpStorm\Metadata;

use Arokettu\PhpStorm\Metadata\Common\Metadata;
use Arokettu\PhpStorm\Metadata\Containers\ContainerIterator;
use Arokettu\PhpStorm\Metadata\Containers\DI\DIIterator;
use Arokettu\PhpStorm\Metadata\Containers\Laminas\ServiceManagerIterator;
use Arokettu\PhpStorm\Metadata\Containers\Pimple\PimpleIterator;
use Arokettu\PhpStorm\Metadata\Containers\Pimple\Psr11ContainerIterator;
use Arokettu\PhpStorm\Metadata\Containers\Pimple\ServiceLocatorIterator;
use Arokettu\PhpStorm\Metadata\Containers\StaticMap\StaticMapIterator;
use DI\Container as DI;
use Laminas\ServiceManager\ServiceManager as LaminasServiceManager;
use Pimple\Container as Pimple;
use Pimple\Psr11\Container as PimplePsr11;
use Pimple\Psr11\ServiceLocator as PimpleServiceLocator;

final class Generator
{
    public static function get(array $containers, array $options = []): string
    {
        if (\count($containers) === 0) {
            throw new \RuntimeException('$containers must contain at least one container');
        }

        $options = self::applyDefaults($containers[0], $options);

        $iterators = array_map(function ($container) {
            $iteratorClass = self::getIteratorClass($container);
            return new $iteratorClass($container);
        }, $containers);

        $metadata = new Metadata(...$iterators);
        return $metadata->render($options['overrides']);
    }

    /**
     * @param string    $filename   path to store map (absolute realpath if possible)
     * @param array     $containers array of containers to store
     * @param array     $options    options
     * @return bool
     */
    public static function store(string $filename, array $containers, array $options = []): bool
    {
        $dirname = \dirname($filename);

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

    private static function applyDefaults(object $container, array $options): array
    {
        if ($container instanceof StaticMap) {
            throw new \RuntimeException('StaticMap should not be the first supplied container');
        }

        $iteratorClass = self::getIteratorClass($container);

        return array_merge($iteratorClass::getDefaultOptions(), $options);
    }

    /**
     * @return class-string<ContainerIterator>
     */
    private static function getIteratorClass(object $container): string
    {
        // internal static map
        if ($container instanceof StaticMap) {
            return StaticMapIterator::class;
        }

        // Pimple
        if ($container instanceof Pimple) {
            return PimpleIterator::class;
        }
        if ($container instanceof PimplePsr11) {
            return Psr11ContainerIterator::class;
        }
        if ($container instanceof PimpleServiceLocator) {
            return ServiceLocatorIterator::class;
        }

        // Laminas
        if ($container instanceof LaminasServiceManager) {
            return ServiceManagerIterator::class;
        }

        // PHP-DI
        if ($container instanceof DI) {
            return DIIterator::class;
        }

        throw new \InvalidArgumentException('Unsupported container');
    }
}
