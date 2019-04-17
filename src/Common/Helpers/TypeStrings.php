<?php

namespace SandFox\PhpStorm\Metadata\Common\Helpers;

final class TypeStrings
{
    const TYPE_NAMES = [
        'string',
        'integer',
        'double',
        'boolean',
        'object',
        'resource',
        'NULL',
        // no array here because it needs special handling
    ];

    public static function getTypeStringByInstance($instance): string
    {
        if (is_object($instance)) {
            $class = get_class($instance);
            if (strpos($class, "\0") === false) {
                $typeString = "\\{$class}::class";
            } else { // handle anonymous class
                $typeString = 'object::class';
            }
        } elseif (is_array($instance)) {
            $typeString = "\\ArrayObject::class"; // array::class shows error, try to approximate
        } else {
            $typeString = gettype($instance) . '::class';
        }

        return $typeString;
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
