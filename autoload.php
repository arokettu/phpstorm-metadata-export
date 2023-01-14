<?php

declare(strict_types=1);

namespace SandFox\Bencode\Legacy;

const NS = 'SandFox\\PhpStorm\\Metadata\\';
const PREFIX_1 = 'Arokettu\\PhpStorm\\Metadata\\';
const PREFIX_1_LEN = 27;
const PREFIX_2 = 'SandFoxMe\\PhpStorm\\Metadata\\';
const PREFIX_2_LEN = 28;

spl_autoload_register(function (string $class_name) {
    if (strncmp($class_name, PREFIX_1, PREFIX_1_LEN) === 0) {
        $realName = NS . substr($class_name, PREFIX_1_LEN);
        class_alias($realName, $class_name);
        return true;
    }

    if (strncmp($class_name, PREFIX_2, PREFIX_2_LEN) === 0) {
        $realName = NS . substr($class_name, PREFIX_2_LEN);
        class_alias($realName, $class_name);
        return true;
    }

    return null;
});
