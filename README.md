PHPUnit listener to run Laravel database migrations before each testsuite
=====

[![Latest Version](https://img.shields.io/github/release/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](https://github.com/softonic/laravel-database-migrate-test-listener/releases)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-blue.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/softonic/laravel-database-migrate-test-listener/master.svg?style=flat-square)](https://travis-ci.org/softonic/laravel-database-migrate-test-listener)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](https://scrutinizer-ci.com/g/softonic/laravel-database-migrate-test-listener/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](https://scrutinizer-ci.com/g/softonic/laravel-database-migrate-test-listener)
[![Total Downloads](https://img.shields.io/packagist/dt/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](https://packagist.org/packages/softonic/laravel-database-migrate-test-listener)
[![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](http://isitmaintained.com/project/softonic/laravel-database-migrate-test-listener "Average time to resolve an issue")
[![Percentage of issues still open](http://isitmaintained.com/badge/open/softonic/laravel-database-migrate-test-listener.svg?style=flat-square)](http://isitmaintained.com/project/softonic/laravel-database-migrate-test-listener "Percentage of issues still open")

This PHPUnit listener run Laravel migrations before each testsuit

Installation
-------

Via composer:
```
composer require --dev softonic/laravel-database-migrate-test-listener
```

Documentation
-------

To use the listener add it to your phpunit.xml, defining on which test suites it should be activated, if it should seed data and the database connection to use.

```
<listeners>
    ...
    <listener class="Softonic\DatabaseMigrateTestListener\DatabaseMigrateTestListener">
        <arguments>
            <array>
              <element key="0">
                <string>Feature</string>
              </element>
              <element key="1">
                <string>Integration</string>
              </element>
            </array>
            <integer>1</integer> <!-- Set 1 if you want to seed data -->
            <string>sqlite</string> <!-- Database connection -->
            <string>>App\\Database\\Seeds\\Foo\\DatabaseSeeder</string> <!-- Database Seeder -->
        </arguments>
    </listener>
    ...
</listeners>
```

From now on before the specified test suite is run, the `migrate:fresh` Laravel command will be executed.

Testing
-------

`softonic/laravel-database-migrate-test-listener` has a [PHPUnit](https://phpunit.de) test suite and a coding style compliance test suite using [PHP CS Fixer](http://cs.sensiolabs.org/).

To run the tests, run the following command from the project folder.

``` bash
$ docker-compose run test
```

License
-------

The Apache 2.0 license. Please see [LICENSE](LICENSE) for more information.

[PSR-2]: http://www.php-fig.org/psr/psr-2/
[PSR-4]: http://www.php-fig.org/psr/psr-4/
