Supported Containers
####################

Pimple
======

The library has full support for the Pimple DI version 3.*

PHP-DI
======

The library has full support for the PHP-DI version 6.*

Laminas (Zend) ServiceManager
=============================

The library has partial support for the Laminas ServiceManager and Zend ServiceManager.
Please note that there's no open and public way of iterating over SM entries
so the implementation is tied to the internal structure
not covered by the semantic version compatibility promise.
Feel free to open an issue if it is broken for some scenario.

Obviously the implementation also cannot create hints for abstract factories

The library is tested against Zend SM version 3.3 and should work with any 3.* version
