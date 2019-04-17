<?php

namespace SandFoxMe\PhpStorm\Metadata
{
    /**
     * @deprecated use \SandFox\PhpStorm\Metadata\Generator
     */
    final class Generator
    {
        // cannot extend Generator because it is final, use proxy method
        public static function __callStatic($name, $arguments)
        {
            return call_user_func_array([\SandFox\PhpStorm\Metadata\Generator::class, $name], $arguments);
        }
    }

    /**
     * @deprecated use \SandFox\PhpStorm\Metadata\StaticMap
     */
    class StaticMap extends \SandFox\PhpStorm\Metadata\StaticMap {}
}

namespace SandFoxMe\PhpStorm\Metadata\Integration\Psr15
{
    /**
     * @deprecated use \SandFox\PhpStorm\Metadata\Integration\Psr15\ContainerExportMiddleware
     */
    class ContainerExportMiddleware extends \SandFox\PhpStorm\Metadata\Integration\Psr15\ContainerExportMiddleware {}
}

namespace SandFoxMe\PhpStorm\Metadata\Integration\Silex
{
    /**
     * @deprecated use \SandFox\PhpStorm\Metadata\Integration\Silex\ContainerExportProvider
     */
    class ContainerExportProvider extends \SandFox\PhpStorm\Metadata\Integration\Silex\ContainerExportProvider {}
}

namespace SandFoxMe\PhpStorm\Metadata\Integration\Slim
{
    /**
     * @deprecated use \SandFox\PhpStorm\Metadata\Integration\Slim\ContainerExportMiddleware
     */
    class ContainerExportMiddleware extends \SandFox\PhpStorm\Metadata\Integration\Slim\ContainerExportMiddleware {}
}
