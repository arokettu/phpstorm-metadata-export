<?php

namespace SandFoxMe\PhpStorm\Metadata;

class_alias(
    \SandFox\PhpStorm\Metadata\Generator::class,
    \SandFoxMe\PhpStorm\Metadata\Generator::class
);

if (\false) {
    /**
     * @deprecated use \SandFox\PhpStorm\Metadata\Generator
     */
    final class Generator
    {
        // cannot extend Generator because it is final, use proxy method
        public static function __callStatic($name, $arguments)
        {
            return call_user_func_array([
                \SandFox\PhpStorm\Metadata\Generator::class,
                $name
            ], $arguments);
        }
    }
}
