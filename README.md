# Metadata Exporter for PhpStorm

[![Packagist]][Packagist Link]
[![license]][MIT License]
[![Gitlab pipeline status]][pipelines]
[![Codecov]][codecov link]

[Packagist]: https://img.shields.io/packagist/v/arokettu/phpstorm-metadata-export.svg?style=flat-square
[license]: https://img.shields.io/github/license/arokettu/phpstorm-metadata-export.svg?style=flat-square
[Gitlab pipeline status]: https://img.shields.io/gitlab/pipeline/sandfox/phpstorm-metadata-export/master.svg?style=flat-square
[Codecov]: https://img.shields.io/codecov/c/gl/sandfox/phpstorm-metadata-export?style=flat-square

[Packagist Link]: https://packagist.org/packages/arokettu/phpstorm-metadata-export
[pipelines]: https://gitlab.com/sandfox/phpstorm-metadata-export/-/pipelines
[codecov link]: https://codecov.io/gl/sandfox/phpstorm-metadata-export/

Export [PhpStorm Advanced Metadata] from DI containers to enable code completion.

The library is inspired by [Pimple Container Dumper] for Silex,
but it doesn't require IDE plugin because it uses native PhpStorm export format.
It can integrate with any PSR-15 compliant framework
and is extensible to support more DI containers and frameworks in the future.

[PhpStorm Advanced Metadata]: https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata
[Pimple Container Dumper]: https://github.com/Sorien/silex-pimple-dumper

## Installation

Install by composer

```sh
composer require arokettu/phpstorm-metadata-export --dev
```

## Container Support

Supported containers:

* [Pimple] (v3)
* [PHP-DI] (v6, v7)
* [Laminas ServiceManager] (v3, v4; permanently unstable)

Integration middlewares for:

* [PSR-15] (Mezzio, Slim 4, ...)
* [Slim 3]

[Pimple]:   https://github.com/silexphp/Pimple
[PHP-DI]:   http://php-di.org/
[Laminas ServiceManager]:   https://docs.laminas.dev/laminas-servicemanager/
[Slim 3]:   https://www.slimframework.com/
[PSR-15]:   https://www.php-fig.org/psr/psr-15/

## Example

```php
<?php

$container = new \DI\Container();
// .phpstorm.meta.php must be in a root path of your project
$storePath = __DIR__ '/.phpstorm.meta.php/sandfox_container_export.meta.php';

// just generate the file content
$metaPhp = \Arokettu\PhpStorm\Metadata\Generator::get([$container]);
file_put_contents($storePath, $metaPhp);

// use middleware (Slim 4 example)
$app = new \Slim\App();
$app->addMiddleware(new \Arokettu\PhpStorm\Metadata\Integration\ContainerExportMiddleware($container, [
    'filename' => $storePath,
]));
```

## Documentation

Read full documentation at <https://sandfox.dev/php/metadata-exporter-phpstorm.html>

Also on Read the Docs: <https://phpstorm-metadata-export.readthedocs.io/>

## Support

Please file issues on our main repo at GitLab: <https://gitlab.com/sandfox/phpstorm-metadata-export/-/issues>

Feel free to ask any questions in our room on Gitter: <https://gitter.im/arokettu/community>

## License

The library is available as open source under the terms of the [MIT License].
See [LICENSE.md][MIT License].

[MIT License]: ./LICENSE.md
