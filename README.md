# PhpStorm Metadata Export

[![Packagist](https://img.shields.io/packagist/v/sandfoxme/phpstorm-metadata-export.svg)](https://packagist.org/packages/sandfoxme/phpstorm-metadata-export)
[![license](https://img.shields.io/github/license/sandfoxme/phpstorm-metadata-export.svg)](https://opensource.org/licenses/MIT)
[![Code Climate](https://img.shields.io/codeclimate/maintainability/sandfoxme/phpstorm-metadata-export.svg)](https://codeclimate.com/github/sandfoxme/phpstorm-metadata-export)

Export [PhpStorm Advanced Metadata](https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata)
from DI containers to enable code completion.

The library is inspired by [Pimple Container Dumper](https://github.com/Sorien/silex-pimple-dumper) for Silex but
doesn't require IDE plugin because it uses native PhpStorm export format. It also supports Slim and is extensible to
support more DI containers and frameworks in future.

## Installation

Install by composer

```sh
composer require sandfoxme/phpstorm-metadata-export --dev
```

## Support

Supported containers:

* Pimple
* PHP-DI
* Zend ServiceManager (experimental)

Integration middlewares for:

* Slim
* Silex
* Psr-15

## Documentation

Read full documentation at <https://sandfox.dev/php/phpstorm-metadata-export.html>

## License

The library is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).
See LICENSE.md

