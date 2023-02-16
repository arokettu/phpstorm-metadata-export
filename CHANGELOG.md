# Changelog

## 3.x

### 3.0.0

*Jan 14, 2023*

* Removed support for Zend ServiceManager, use Laminas instead
* Base namespace was changed to `Arokettu\PhpStorm\Metadata`
* The package was renamed to `arokettu/phpstorm-metadata-export`

## 2.x

### 2.1.1

*Feb 16, 2023*

* Fixed invalid dependency declaration for symfony/deprecation-contracts.
  3.x is now properly installable. 

### 2.1.0

*Jan 14, 2023*

* Deprecated support for Zend ServiceManager, use Laminas instead
* Added `Arokettu\PhpStorm\Metadata` namespace alias for `SandFox\PhpStorm\Metadata` for 3.0 compatibility.

### 2.0.0

*Sep 30, 2021*

Breaking changes are explained in the Upgrades section in the docs.

* PHP 7.1 is now required
* Silex support was dropped
* SandFoxMe namespace was dropped
* Extensive refactoring and fixes in the ServiceManager support
* Tests!
* ``Integration\Slim\ContainerExportMiddleware`` and
  ``Integration\Psr15\ContainerExportMiddleware`` were combined into
  ``Integration\ContainerExportMiddleware``
* Type strings for scalars now correspond to the values returned by ``get_debug_type()``

## 1.x

### 1.8.0

*Jan 14, 2023*

* Added `Arokettu\PhpStorm\Metadata` namespace alias for `SandFox\PhpStorm\Metadata` for 3.0 compatibility.

### 1.7.1

*Sep 29, 2021*

* Fixed semantic version inconsistency introduced in 1.6: roll back to PHP 7.0

### 1.7.0

*Jan 18, 2021*

* Fix compatibility with Laminas ServiceManager 3.6
* Deprecate Silex support

### 1.6.0

*Aug 28, 2020*

* Simplify handling of scalars
* Require PHP 7.1

### 1.5.0

*Jan 02, 2020*

* Add explicit support for Laminas

### 1.4.0

*Jul 18, 2019*

* Add support for PHP-DI

### 1.3.1

*Apr 17, 2019*

* Avoid crash when Slim or Silex are not installed while using legacy class names

### 1.3.0

*Apr 17, 2019*

* Change base namespace to `SandFox`

### 1.2.5

*Nov 01, 2018*

* Remove autoload protection because it doesn't work as expected

### 1.2.4

*Sep 18, 2018*

* Fix incorrect handling of factories

### 1.2.3

*Sep 18, 2018*

* Another fix for Zend service discovery

### 1.2.2

*Sep 17, 2018*

* Retrieve services from Zend without initiation

### 1.2.1

*Sep 17, 2018*

* Suppress warnings in Zend Service retrieval

### 1.2.0

*Sep 06, 2018*

* Add support for Zend ServiceManager

### 1.1.0

*Mar 03, 2018*

* Add support for Psr-15

### 1.0.1

*Feb 24, 2018*

* Fix options not being correctly passed to Generator from Slim Middleware
* Log exception that is caught during export in Slim and Silex to the export file

### 1.0.0

*Feb 22, 2018*

* Initial release
