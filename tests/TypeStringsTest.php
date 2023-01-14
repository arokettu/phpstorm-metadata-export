<?php

/**
 * phpcs:disable Squiz.WhiteSpace.ScopeClosingBrace.ContentBefore
 */

declare(strict_types=1);

namespace Arokettu\PhpStorm\Metadata\Tests;

use Arokettu\PhpStorm\Metadata\Common\Helpers\TypeStrings;
use PHPUnit\Framework\TestCase;

class TypeStringsTest extends TestCase
{
    public function testByInstance(): void
    {
        $testValues = [
            123,
            123.45,
            'string',
            true,
            null,
            [],
        ];

        foreach ($testValues as $value) {
            self::assertEquals("'" . get_debug_type($value) . "'", TypeStrings::getTypeStringByInstance($value));
        }

        // resource
        $resource = fopen(__FILE__, 'r');
        self::assertEquals("'resource'", TypeStrings::getTypeStringByInstance($resource));

        // class
        self::assertEquals('\\' . self::class . '::class', TypeStrings::getTypeStringByInstance($this));
        self::assertEquals('\\ArrayObject::class', TypeStrings::getTypeStringByInstance(new \ArrayObject()));
        // anonymous class is 'object'
        self::assertEquals("'object'", TypeStrings::getTypeStringByInstance(new class {}));
    }

    public function testByName(): void
    {
        $types = [
            'int' => "'int'",
            'float' => "'float'",
            'string' => "'string'",
            'bool' => "'bool'",
            'null' => "'null'",
            'array' => "'array'",
            self::class => '\\' . self::class . '::class',
            'ArrayObject' => '\ArrayObject::class',
        ];

        foreach ($types as $typeName => $typeString) {
            self::assertEquals($typeString, TypeStrings::getTypeStringByTypeName($typeName));
        }
    }
}
