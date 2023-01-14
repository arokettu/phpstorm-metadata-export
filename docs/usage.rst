Usage
#####

The library has integration classes available for PSR-15 compliant frameworks and legacy Slim.
By default exporter will create directory ``.phpstorm.meta.php`` in the root path of your project
(where ``vendor`` directory is) and put metadata file to it on every request.
It is a good idea to enable integration components only in development environment.
Don't forget to gitignore your ``.phpstorm.meta.php`` directory.

Using Generator directly
========================

.. code-block:: php

    <?php

    use Arokettu\PhpStorm\Metadata\Generator;

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

PSR-15
======

The library provides a middleware implementation for PSR-15 compliant framework like Slim 4 or Mezzio.
The classname is ``Arokettu\PhpStorm\Metadata\Integration\ContainerExportMiddleware``.

.. code-block:: php

    <?php

    use Arokettu\PhpStorm\Metadata\Integration\ContainerExportMiddleware;

    $middleware = new ContainerExportMiddleware($container);

    // You can also override metadata filename like this
    $middleware = new ContainerExportMiddleware($container, [
        // it is a good idea to use full path here
        'filename' => '/path/to/project/.phpstorm.meta.php/my_export_file.meta.php',
    ]);

    // Register middleware the way your framework allows it
    $myPsr15CompliantApp->registerMiddleware($middleware);

Slim 3
======

``ContainerExportMiddleware`` can also work as a legacy Slim 3 middleware.
Add it to your Slim 3 app:

.. code-block:: php

    <?php

    use Arokettu\PhpStorm\Metadata\Integration\ContainerExportMiddleware;
    use Slim\App;

    $app = new App();

    $app->add(new ContainerExportMiddleware($app->getContainer()));

    // You can also override metadata filename like this
    $app->add(new ContainerExportMiddleware($app->getContainer(), [
        // it is a good idea to use full path here
        'filename' => '/path/to/project/.phpstorm.meta.php/my_export_file.meta.php',
    ]));
