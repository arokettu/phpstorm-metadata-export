<?php

namespace SandFox\PhpStorm\Metadata\Integration;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SandFox\PhpStorm\Metadata\Generator;

final class ContainerExportMiddleware implements MiddlewareInterface
{
    private $container;
    private $options;

    public function __construct($container, $options = [])
    {
        $this->container = $container;
        $this->options   = $options;
    }

    /**
     * PSR-15 Middleware
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } finally {
            $this->exportMetadata();
        }
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ): ResponseInterface {
        try {
            return $next($request, $response);
        } finally {
            $this->exportMetadata();
        }
    }

    private function exportMetadata(): void
    {
        // try to find root path of the project (parent of vendor)
        // remove path postfix vendor/sandfoxme/phpstorm-metadata-export/src/Integration
        $filename = $this->options['filename'] ??
            realpath(__DIR__ . '/../../../../..') .
            '/.phpstorm.meta.php/sandfox_container_export.meta.php';
        try {
            Generator::store($filename, [$this->container], $this->options['options'] ?? []);
        } catch (\Throwable $e) {
            file_put_contents($filename, "Exception: " . get_class($e) . "\n" . $e->getMessage());
        }
    }
}
