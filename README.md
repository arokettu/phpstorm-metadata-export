# PhpStorm Metadata Export

Export [PhpStorm Advanced Metadata](https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata)
from DI containers to enable autocomplete.

The library is inspired by [Pimple Container Dumper](https://github.com/Sorien/silex-pimple-dumper) for Silex but
doesn't require IDE plugin because it uses native PhpStorm export format. It also supports Slim and is extensible to
support more DI containers and frameworks in future.

## Installation

Install by composer

```sh
composer require sandfoxme/phpstorm-metadata-export --dev
```

## Usage

The library supports Pimple DI and has integration classes available for Slim and Silex.
By default exporter will create directory `.phpstorm.meta.php` in the root path of your project 
(where `vendor` directory is) and put metadata file to it on every request.
It is a good idea to enable integration components only in development environment.
Don't forget to gitignore your `.phpstorm.meta.php` directory.

### Slim

Add middleware class `SandFoxMe\PhpStorm\Metadata\Integration\Slim\ContainerExportMiddleware` to your Slim app.

```php
<?php

use Slim\App;
use SandFoxMe\PhpStorm\Metadata\Integration\Slim\ContainerExportMiddleware;

$app = new App();

$app->add(new ContainerExportMiddleware($app->getContainer()));

// You can also override metadata filename like this
$app->add(new ContainerExportMiddleware($app->getContainer(), [
    // it is a good idea to use full path here
    'filename' => '/path/to/project/.phpstorm.meta.php/my_export_file.meta.php',
]));
```

### Silex

Add service provider class `SandFoxMe\PhpStorm\Metadata\Integration\Silex\ContainerExportProvider` to your Silex app.

```php
<?php

use Silex\Application;
use SandFoxMe\PhpStorm\Metadata\Integration\Silex\ContainerExportProvider;

$app = new Application();

$app->register(new ContainerExportProvider());

// You can also override metadata filename like this
$app->register(new ContainerExportProvider(), [
    // it is a good idea to use full path here
    'phpstorm.metadata.filename' => '/path/to/project/.phpstorm.meta.php/my_export_file.meta.php',
]);
```

## License

The library is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).
See LICENSE.md

