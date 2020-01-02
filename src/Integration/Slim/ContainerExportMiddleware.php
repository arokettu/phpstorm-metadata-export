<?php

namespace SandFox\PhpStorm\Metadata\Integration\Slim;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SandFox\PhpStorm\Metadata\Generator;

class ContainerExportMiddleware
{
    private $container;
    private $options;

    public function __construct($container, $options = [])
    {
        $this->container = $container;
        $this->options   = $options;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ): ResponseInterface {
        try {
            return $next($request, $response);
        } finally {
            // try to find root path of the project (parent of vendor)
            // remove path postfix vendor/sandfoxme/phpstorm-metadata-export/src/Integration/Slim
            $filename = $this->options['filename'] ??
                realpath(__DIR__ . '/../../../../../..') .
                '/.phpstorm.meta.php/sandfoxme_container_export_slim.meta.php';
            try {
                Generator::store($filename, [$this->container], $this->options['options'] ?? []);
            } catch (\Throwable $e) {
                file_put_contents($filename, "Exception: " . get_class($e) . "\n" . $e->getMessage());
            }
        }
    }
}
