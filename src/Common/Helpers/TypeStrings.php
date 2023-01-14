<?php

declare(strict_types=1);

namespace SandFox\PhpStorm\Metadata\Common\Helpers;

/**
 * @internal
 */
final class TypeStrings
{
    const TYPE_NAMES = [
        'string',
        'int',
        'float',
        'bool',
        'object',
        'resource',
        'null',
        'array',
    ];

    private const GETTYPE_TO_TYPE = [
        'integer' => 'int',
        'double' => 'float',
        'boolean' => 'bool',
        'NULL' => 'null',
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
        $type = self::GETTYPE_TO_TYPE[$type] ?? $type;

        return "'{$type}'";
    }

    public static function getTypeStringByTypeName(string $typeName): string
    {
        // treat scalar type names as case-insensitive
        $lowerTypeName = strtolower($typeName);

        if (\in_array($lowerTypeName, self::TYPE_NAMES)) {
            $typeString = "'{$lowerTypeName}'";
        } else {
            $typeString = ltrim($typeName, '\\');
            $typeString = "\\{$typeString}::class";
        }

        return $typeString;
    }
}
