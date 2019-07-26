<?php

namespace Softonic\DatabaseMigrateTestListener;

use Composer\Autoload\ClassLoader;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;
use ReflectionClass;

class DatabaseMigrateTestListener implements TestListener
{
    use TestListenerDefaultImplementation;

    public $testSuites;

    public $itShouldSeed;

    public $connection;

    public function __construct(array $testSuites, bool $itShouldSeed, string $connection = 'sqlite')
    {
        $this->testSuites   = $testSuites;
        $this->itShouldSeed = $itShouldSeed;
        $this->connection   = $connection;
    }

    /**
     * Set up the database for testing.
     *
     * @param TestSuite $suite
     *
     * @throws \ReflectionException
     */
    public function startTestSuite(TestSuite $suite): void
    {
        if (!in_array($suite->getName(), $this->testSuites)) {
            return;
        }

        $reflection   = new ReflectionClass(ClassLoader::class);
        $appDirectory = dirname($reflection->getFileName(), 3);
        chdir($appDirectory);
        $seed = $this->itShouldSeed ? '--seed' : '';
        shell_exec("php artisan migrate:refresh --database {$this->connection} $seed");
    }
}
