<?php

declare(strict_types=1);

namespace SandFox\PhpStorm\Metadata\Common\Helpers;

/**
 * @internal
 */
final class TypeStrings
{
    private const TYPE_NAMES = [
        'string',
        'integer',
        'float',
        'boolean',
        'object',
        'resource',
        'null',
        // no array here because it needs special handling
    ];

    /**
     * @param mixed $instance
     * @return string
     */
    public static function getTypeStringByInstance($instance): string
    {
        if (\is_object($instance)) {
            $class = \get_class($instance);
            // if not anonymous class
            if (strpos($class, "\0") === false) {
                return "\\{$class}::class";
            }
        }

        $type = \gettype($instance);

        if ($type === 'double') {
            $type = 'float';
        } elseif ($type === 'NULL') {
            $type = 'null';
        }

        return "'{$type}'";
    }

    public static function getTypeStringByTypeName(string $typeName): string
    {
        // treat scalar type names as case-insensitive
        $lowerTypeName = strtolower($typeName);

        if (\in_array($lowerTypeName, self::TYPE_NAMES)) {
            $typeString = "'{$lowerTypeName}'";
        } elseif ($typeName === 'array') {
            $typeString = '\\ArrayObject::class';
        } else {
            $typeString = ltrim($typeName, '\\');
            $typeString = "\\{$typeString}::class";
        }

        return $typeString;
    }
}
