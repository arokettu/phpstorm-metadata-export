Supported Containers
####################

Pimple
======

The library supports Pimple DI version 3.*

Supported containers:

* ``Pimple\Container``: full support
* ``Pimple\Psr11\Container``: may be unstable
* ``Pimple\Psr11\ServiceLocator``: may be unstable

PHP-DI
======

The library has full support for the PHP-DI versions 6.* and 7.*

Laminas ServiceManager
======================

The library has partial support for the Laminas ServiceManager.
Please note that there's no open and public way of iterating over SM entries
so the implementation is tied to the internal structure
not covered by the semantic version compatibility promise.
Feel free to open an issue if it is broken for some scenario.

Abstract factories and lazy services are not supported.
Abstract factories support is impossible.
Lazy services support would be too complicated.

The library is tested against Laminas SM version 3.3 and should work with any 3.* version
