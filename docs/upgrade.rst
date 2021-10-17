Upgrade
#######

1.x to 2.0
==========

* PHP requirement was bumped to 7.1.
* Legacy namespace ``SandFoxMe\`` was removed, replace it with ``SandFox\`` if you still use it.
* Silex integration was removed.
  Just don't use EOL'd frameworks, switch to Slim, Mezzio or Symfony Flex.
  If you still need it, you can create your own provider based on the ``ContainerExportProvider`` from 1.x branch.
  (`source <https://gitlab.com/sandfox/phpstorm-metadata-export/-/blob/1.x/src/Integration/Silex/ContainerExportProvider.php>`__)
* ``SandFox\PhpStorm\Metadata\Integration\Psr15\ContainerExportMiddleware`` and
  ``SandFox\PhpStorm\Metadata\Integration\Slim\ContainerExportMiddleware`` were combined into
  ``SandFox\PhpStorm\Metadata\Integration\ContainerExportMiddleware``.
  Replace accordingly.
