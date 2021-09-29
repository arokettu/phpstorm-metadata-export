Upgrade
#######

1.x to 2.0
==========

* PHP requirement was bumped to 7.1.
* Legacy namespace ``SandFoxMe\\`` was removed, replace it with ``SandFox\\`` if you still have it.
* Silex integration was removed.
* ``SandFox\PhpStorm\Metadata\Integration\Psr15\ContainerExportMiddleware`` and
  ``SandFox\PhpStorm\Metadata\Integration\Slim\ContainerExportMiddleware`` were combined into
  ``SandFox\PhpStorm\Metadata\Integration\ContainerExportMiddleware``.
  Replace accordingly.
