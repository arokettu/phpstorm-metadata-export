<?php

namespace SandFoxMe\PhpStorm\Metadata\Integration\Psr15;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SandFoxMe\PhpStorm\Metadata\Generator;

class ContainerExportMiddleware implements MiddlewareInterface
{
    private $container;
    private $options;

    public function __construct($container, $options = [])
    {
        $this->container = $container;
        $this->options   = $options;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } finally {
            // try to find root path of the project (parent of vendor)
            // remove path postfix vendor/sandfoxme/phpstorm-metadata-export/src/Integration/Psr15
            $filename = $this->options['filename'] ??
                realpath(__DIR__ . '/../../../../../..') .
                '/.phpstorm.meta.php/sandfoxme_container_export_psr15.meta.php';
            try {
                Generator::store($filename, [$this->container], $this->options['options'] ?? []);
            } catch (\Throwable $e) {
                file_put_contents($filename, "Exception: " . get_class($e) . "\n" . $e->getMessage());
            }
        }
    }
}
