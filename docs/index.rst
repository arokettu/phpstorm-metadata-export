PhpStorm Metadata Export
########################

|Packagist| |GitLab| |GitHub| |Bitbucket| |Gitea|

Export `PhpStorm Advanced Metadata`_ from DI containers to enable code completion.

The library is inspired by `Pimple Container Dumper`_ for Silex
but it doesn't require IDE plugin because it uses native PhpStorm export format.
It can integrate with any PSR-15 compliant framework
and is extensible to support more DI containers and frameworks in the future.

Installation
============

Install by composer

.. code-block:: bash

    composer require sandfoxme/phpstorm-metadata-export --dev

Documentation
=============

.. toctree::

    usage
    containers
    upgrade

License
=======

The library is available as open source under the terms of the `MIT License`_.
See LICENSE.md

.. _PhpStorm Advanced Metadata: https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata
.. _Pimple Container Dumper:    https://github.com/Sorien/silex-pimple-dumper
.. _MIT License:                https://opensource.org/licenses/MIT

.. |Packagist|  image:: https://img.shields.io/packagist/v/sandfoxme/phpstorm-metadata-export.svg?style=flat-square
   :target:     https://packagist.org/packages/sandfoxme/phpstorm-metadata-export
.. |GitHub|     image:: https://img.shields.io/badge/get%20on-GitHub-informational.svg?style=flat-square&logo=github
   :target:     https://github.com/arokettu/phpstorm-metadata-export
.. |GitLab|     image:: https://img.shields.io/badge/get%20on-GitLab-informational.svg?style=flat-square&logo=gitlab
   :target:     https://gitlab.com/sandfox/phpstorm-metadata-export
.. |Bitbucket|  image:: https://img.shields.io/badge/get%20on-Bitbucket-informational.svg?style=flat-square&logo=bitbucket
   :target:     https://bitbucket.org/sandfox/phpstorm-metadata-export
.. |Gitea|      image:: https://img.shields.io/badge/get%20on-Gitea-informational.svg?style=flat-square&logo=gitea
   :target:     https://sandfox.org/sandfox/phpstorm-metadata-export
