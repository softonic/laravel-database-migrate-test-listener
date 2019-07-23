<?php

namespace Softonic\DatabaseMigrateTestListener;

use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;

class DatabaseMigrateTestListener implements TestListener
{
    use TestListenerDefaultImplementation;

    public $testSuites;

    public function __construct(...$testSuites)
    {
        $this->testSuites = $testSuites;
    }

    /**
     * Set up the database for testing.
     *
     * @param TestSuite $suite
     */
    public function startTestSuite(TestSuite $suite): void
    {
        if (!in_array($suite->getName(), $this->testSuites)) {
            return;
        }

        chdir(__DIR__ . '/../../../../');

        shell_exec('php artisan migrate:refresh --seed');
    }
}
