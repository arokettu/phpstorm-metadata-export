# PhpStorm Metadata Export

[![Packagist](https://img.shields.io/packagist/v/sandfoxme/phpstorm-metadata-export.svg)](https://packagist.org/packages/sandfoxme/phpstorm-metadata-export)
[![license](https://img.shields.io/github/license/sandfoxme/phpstorm-metadata-export.svg)](https://opensource.org/licenses/MIT)
[![Code Climate](https://img.shields.io/codeclimate/maintainability/sandfoxme/phpstorm-metadata-export.svg)](https://codeclimate.com/github/sandfoxme/phpstorm-metadata-export)

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
* [Laminas ServiceManager] / [Zend ServiceManager] (experimental)

Integration middlewares for:

* [Slim]
* [Silex]
* [PSR-15] (Zend Expressive, Mezzo, Slim 4, ...)

[Pimple]:   https://pimple.symfony.com/
[PHP-DI]:   http://php-di.org/
[Laminas ServiceManager]:   https://docs.laminas.dev/laminas-servicemanager/
[Zend ServiceManager]:      https://docs.zendframework.com/zend-servicemanager/
[Slim]:     https://www.slimframework.com/
[Silex]:    https://silex.symfony.com/
[PSR-15]:   https://www.php-fig.org/psr/psr-15/

## Documentation

Read full documentation at <https://sandfox.dev/php/phpstorm-metadata-export.html>

## License

The library is available as open source under the terms of the [MIT License].
See LICENSE.md

[MIT License]: https://opensource.org/licenses/MIT
