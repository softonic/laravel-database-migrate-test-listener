PHPUnit listener to run Laravel database migrations before each testsuite
=====

[![Latest Version](https://img.shields.io/github/release/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](https://github.com/softonic/laravel-database-migrate-test-listener/releases)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-blue.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/softonic/laravel-database-migrate-test-listener/master.svg?style=flat-square)](https://travis-ci.org/softonic/laravel-database-migrate-test-listener)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](https://scrutinizer-ci.com/g/softonic/laravel-database-migrate-test-listener/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](https://scrutinizer-ci.com/g/softonic/laravel-database-migrate-test-listener)
[![Total Downloads](https://img.shields.io/packagist/dt/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](https://packagist.org/packages/softonic/laravel-database-migrate-test-listener)

This PHPUnit listener run Laravel migrations before each testsuit

Installation
-------

Via composer:
```
composer require --dev softonic/laravel-database-migrate-test-listener
```

Documentation
-------

To use the listener add it to your phpunit.xml, defining which test suites should use it

```
<listeners>
    ...
    <listener class="Tests\DatabaseTestListener">
        <arguments>
            <string>Feature</string>
            <string>Integration</string>
        </arguments>
    </listener>
    ...
</listeners>
```

From now on before the specified test suite is run, the `migrate:fresh --seed` Laravel command will be executed.

Testing
-------

`softonic/laravel-database-migrate-test-listener` has a [PHPUnit](https://phpunit.de) test suite and a coding style compliance test suite using [PHP CS Fixer](http://cs.sensiolabs.org/).

To run the tests, run the following command from the project folder.

``` bash
$ docker-compose run tests
```

To run interactively using [PsySH](http://psysh.org/):
``` bash
$ docker-compose run psysh
```

License
-------

The Apache 2.0 license. Please see [LICENSE](LICENSE) for more information.

[PSR-2]: http://www.php-fig.org/psr/psr-2/
[PSR-4]: http://www.php-fig.org/psr/psr-4/