# PhpStorm Metadata Export

[![Packagist]][Packagist Link]
[![license]][MIT License]
[![Code Climate]][Packagist Link]
[![Gitlab pipeline status]][pipelines]
[![Codecov]][codecov link]

[Packagist]: https://img.shields.io/packagist/v/sandfoxme/phpstorm-metadata-export.svg?style=flat-square
[license]: https://img.shields.io/github/license/sandfoxme/phpstorm-metadata-export.svg?style=flat-square
[Code Climate]: https://img.shields.io/codeclimate/maintainability/sandfoxme/phpstorm-metadata-export.svg?style=flat-square
[Gitlab pipeline status]: https://img.shields.io/gitlab/pipeline/sandfox/phpstorm-metadata-export/master.svg?style=flat-square
[Codecov]: https://img.shields.io/codecov/c/gl/sandfox/phpstorm-metadata-export?style=flat-square

[Packagist Link]: https://packagist.org/packages/sandfoxme/phpstorm-metadata-export
[pipelines]: https://gitlab.com/sandfox/phpstorm-metadata-export/-/pipelines
[codecov link]: https://codecov.io/gl/sandfox/phpstorm-metadata-export/

Export [PhpStorm Advanced Metadata] from DI containers to enable code completion.

The library is inspired by [Pimple Container Dumper] for Silex
but it doesn't require IDE plugin because it uses native PhpStorm export format.
It also supports Slim and is extensible to support more DI containers and frameworks in future.

[PhpStorm Advanced Metadata]: https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata
[Pimple Container Dumper]: https://github.com/Sorien/silex-pimple-dumper

## Installation

Install by composer

```sh
composer require sandfoxme/phpstorm-metadata-export --dev
```

## Support

Supported containers:

* [Pimple]
* [PHP-DI]
* [Laminas ServiceManager] / [Zend ServiceManager] (unstable)

Integration middlewares for:

* [PSR-15] (Mezzio, Slim 4, ...)
* [Slim 3]

[Pimple]:   https://pimple.symfony.com/
[PHP-DI]:   http://php-di.org/
[Laminas ServiceManager]:   https://docs.laminas.dev/laminas-servicemanager/
[Zend ServiceManager]:      https://docs.zendframework.com/zend-servicemanager/
[Slim 3]:   https://www.slimframework.com/
[Silex]:    https://silex.symfony.com/
[PSR-15]:   https://www.php-fig.org/psr/psr-15/

## Documentation

Read full documentation at <https://sandfox.dev/php/phpstorm-metadata-export.html>

Also on Read the Docs: <https://phpstorm-metadata-export.readthedocs.io/>

## License

The library is available as open source under the terms of the [MIT License].
See LICENSE.md

[MIT License]: https://opensource.org/licenses/MIT
