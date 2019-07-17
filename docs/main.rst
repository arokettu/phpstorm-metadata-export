PhpStorm Metadata Export
########################

|Packagist| |GitHub| |Gitlab| |Bitbucket| |Gitea|

Export `PhpStorm Advanced Metadata`_ from DI containers to enable code completion.

The library is inspired by `Pimple Container Dumper`_ for Silex
but it doesn't require IDE plugin because it uses native PhpStorm export format.
It also supports Slim and is extensible to support more DI containers and frameworks in future.

Installation
============

Install by composer

.. code-block:: bash

    composer require sandfoxme/phpstorm-metadata-export --dev

Containers
==========

Pimple
------

The library has full support for the Pimple DI version 3.*

PHP-DI
------

The library has full support for the PHP-DI version 6.*

Zend ServiceManager
-------------------

The library has partial support for the Zend ServiceManager. Please note that there's no open and public way
of iterating over SM entries so the implementation is tied to the internal structure not covered by
the semantic version compatibility promise. Feel free to open an issue if it is broken for some scenario

Obviously the implementation also cannot create hints for abstract factories

The library is tested against Zend SM version 3.3 and should work with any 3.* version

Usage
=====

The library has integration classes available for Slim and Silex.
By default exporter will create directory ``.phpstorm.meta.php`` in the root path of your project
(where ``vendor`` directory is) and put metadata file to it on every request.
It is a good idea to enable integration components only in development environment.
Don't forget to gitignore your ``.phpstorm.meta.php`` directory.

Using Generator directly
------------------------

.. code-block:: php

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

Slim
----

Add middleware class ``SandFox\PhpStorm\Metadata\Integration\Slim\ContainerExportMiddleware`` to your Slim app.

.. code-block:: php

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

Silex
-----

Add service provider class ``SandFox\PhpStorm\Metadata\Integration\Silex\ContainerExportProvider`` to your Silex app.

.. code-block:: php

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

Psr15
-----

Version 1.1 adds Psr15 compliant middleware implementation. It generally uses the same approach as Slim Middleware.
The classname is ``SandFox\PhpStorm\Metadata\Integration\Psr15\ContainerExportMiddleware``.

.. code-block:: php

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

License
=======

The library is available as open source under the terms of the `MIT License`_.
See LICENSE.md

.. _PhpStorm Advanced Metadata: https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata
.. _Pimple Container Dumper:    https://github.com/Sorien/silex-pimple-dumper
.. _MIT License:                https://opensource.org/licenses/MIT

.. |Packagist|  image:: https://img.shields.io/packagist/v/sandfoxme/phpstorm-metadata-export.svg
   :target: https://packagist.org/packages/sandfoxme/phpstorm-metadata-export
.. |GitHub|     image:: https://img.shields.io/badge/GitHub-phpstorm--metadata--export-informational.svg?logo=github
   :target: https://github.com/sandfoxme/phpstorm-metadata-export
.. |Gitlab|     image:: https://img.shields.io/badge/Gitlab-phpstorm--metadata--export-informational.svg?logo=gitlab
   :target: https://gitlab.com/sandfox/phpstorm-metadata-export
.. |Bitbucket|  image:: https://img.shields.io/badge/Bitbucket-phpstorm--metadata--export-informational.svg?logo=bitbucket
   :target: https://bitbucket.org/sandfox/phpstorm-metadata-export
.. |Gitea|      image:: https://img.shields.io/badge/Gitea-phpstorm--metadata--export-informational.svg
   :target: https://git.sandfox.dev/sandfox/phpstorm-metadata-export
