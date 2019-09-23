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

    public $seeder;

    public function __construct(array $testSuites, bool $itShouldSeed, string $connection = 'sqlite', string $seeder = '')
    {
        $this->testSuites   = $testSuites;
        $this->itShouldSeed = $itShouldSeed;
        $this->connection   = $connection;
        $this->seeder       = $seeder;
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
        $seeder = $this->itShouldSeed && !empty($this->seeder) ? "--seeder={$this->seeder}" : '';

        echo shell_exec("php artisan migrate:refresh --database {$this->connection} $seed $seeder");
    }
}
