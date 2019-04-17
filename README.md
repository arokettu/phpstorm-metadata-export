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

## Containers

### Pimple

The library has full support for the Pimple DI version 3.*

### Zend ServiceManager

The library has partial support for the Zend ServiceManager. Please note that there's no open and public way
of iterating over SM entries so the implementation is tied to the internal structure not covered by
the semantic version compatibility promise. Feel free to open an issue if it is broken for some scenario

Obviously the implementation also cannot create hints for abstract factories

The library is tested against Zend SM version 3.3 and should work with any 3.* version

## Usage

The library has integration classes available for Slim and Silex.
By default exporter will create directory `.phpstorm.meta.php` in the root path of your project 
(where `vendor` directory is) and put metadata file to it on every request.
It is a good idea to enable integration components only in development environment.
Don't forget to gitignore your `.phpstorm.meta.php` directory.

### Using Generator directly

```php
<?php

use SandFox\PhpStorm\Metadata\Generator;

$container = new Container();

file_put_contents(
    '/path/to/project/.phpstorm.meta.php/my_export_file.meta.php',
    Generator::get([$container])
);

// OR

Generator::store(
    '/path/to/project/.phpstorm.meta.php/my_export_file.meta.php',
    [$container]
);
```

### Slim

Add middleware class `SandFox\PhpStorm\Metadata\Integration\Slim\ContainerExportMiddleware` to your Slim app.

```php
<?php

use Slim\App;
use SandFox\PhpStorm\Metadata\Integration\Slim\ContainerExportMiddleware;

$app = new App();

$app->add(new ContainerExportMiddleware($app->getContainer()));

// You can also override metadata filename like this
$app->add(new ContainerExportMiddleware($app->getContainer(), [
    // it is a good idea to use full path here
    'filename' => '/path/to/project/.phpstorm.meta.php/my_export_file.meta.php',
]));
```

### Silex

Add service provider class `SandFox\PhpStorm\Metadata\Integration\Silex\ContainerExportProvider` to your Silex app.

```php
<?php

use Silex\Application;
use SandFox\PhpStorm\Metadata\Integration\Silex\ContainerExportProvider;

$app = new Application();

$app->register(new ContainerExportProvider());

// You can also override metadata filename like this
$app->register(new ContainerExportProvider(), [
    // it is a good idea to use full path here
    'phpstorm.metadata.filename' => '/path/to/project/.phpstorm.meta.php/my_export_file.meta.php',
]);
```

### Psr15

Version 1.1 adds Psr15 compliant middleware implementation. It generally uses the same approach as Slim Middleware.
The classname is `SandFox\PhpStorm\Metadata\Integration\Psr15\ContainerExportMiddleware`.

```php
<?php

use SandFox\PhpStorm\Metadata\Integration\Psr15\ContainerExportMiddleware;

$middleware = new ContainerExportMiddleware($container);

// You can also override metadata filename like this
$middleware = new ContainerExportMiddleware($container, [
    // it is a good idea to use full path here
    'filename' => '/path/to/project/.phpstorm.meta.php/my_export_file.meta.php',
]);

// Register middleware the way your compliant framework allows it
$myPsr15CompliantApp->registerMiddleware($middleware);
```

## License

The library is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).
See LICENSE.md

