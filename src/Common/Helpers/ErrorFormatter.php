<?php

declare(strict_types=1);

namespace SandFox\PhpStorm\Metadata\Common\Helpers;

final class ErrorFormatter
{
    public static function format(\Throwable $exception): string
    {
        return TypeStrings::getTypeStringByInstance($exception) .
            ' /* Error message: "' . $exception->getMessage() . '" */';
    }
}
