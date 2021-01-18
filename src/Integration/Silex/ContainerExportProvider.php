<?php

namespace SandFox\PhpStorm\Metadata\Integration\Silex;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use SandFox\PhpStorm\Metadata\Generator;
use Silex\Api\BootableProviderInterface;
use Silex\Application;

/**
 * @deprecated Since Silex itself is deprecated, deprecate the class too
 */
class ContainerExportProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function __construct()
    {
        trigger_deprecation(
            'sandfoxme/phpstorm-metadata-export',
            '1.7.0',
            'Silex itself is deprecated for a long time now'
        );
    }

    public function register(Container $pimple)
    {
        // try to find root path of the project (parent of vendor)
        // remove path postfix vendor/sandfoxme/phpstorm-metadata-export/src/Integration/Silex
        $pimple['phpstorm.metadata.filename'] = realpath(__DIR__ . '/../../../../../..') .
            '/.phpstorm.meta.php/sandfoxme_container_export_silex.meta.php';

        $pimple['phpstorm.metadata.options'] = [];

        $pimple['phpstorm.metadata.only_debug'] = true;
    }

    public function boot(Application $app)
    {
        if (!$app['phpstorm.metadata.only_debug'] || $app['debug']) {
            $app->finish(function () use ($app) {
                $filename = $app['phpstorm.metadata.filename'];
                try {
                    Generator::store($filename, [$app], $app['phpstorm.metadata.options']);
                } catch (\Throwable $e) {
                    file_put_contents($filename, "Exception: " . get_class($e) . "\n" . $e->getMessage());
                }
            }, Application::LATE_EVENT);
        }
    }
}
