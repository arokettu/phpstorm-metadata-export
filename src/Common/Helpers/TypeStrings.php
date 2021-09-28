<?php

namespace SandFox\PhpStorm\Metadata\Common\Helpers;

/**
 * @internal
 */
final class TypeStrings
{
    private const TYPE_NAMES = [
        'string',
        'integer',
        'double',
        'boolean',
        'object',
        'resource',
        'null',
        // no array here because it needs special handling
    ];

    public static function getTypeStringByInstance($instance): string
    {
        if (is_object($instance)) {
            $class = get_class($instance);
            // if not anonymous class
            if (strpos($class, "\0") === false) {
                return "\\{$class}::class";
            }
        }

        return "'" . gettype($instance) . "'";
    }

    public static function getTypeStringByTypeName(string $typeName): string
    {
        if (in_array($typeName, self::TYPE_NAMES)) {
            $typeString = $typeName . '::class';
        } elseif ($typeName === 'array') {
            $typeString = '\\ArrayObject::class';
        } else {
            $typeString = ltrim($typeName, '\\');
            $typeString = "\\{$typeString}::class";
        }

        return $typeString;
    }
}
