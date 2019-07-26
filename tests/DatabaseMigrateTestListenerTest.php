<?php

namespace Softonic\DatabaseMigrateTestListener\Tests;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use phpmock\mockery\PHPMockery;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestSuite;
use Softonic\DatabaseMigrateTestListener\DatabaseMigrateTestListener;

class DatabaseMigrateTestListenerTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testMigrateCommandHasBeenExecutedWhenTestSuiteMatches()
    {
        $listener = new DatabaseMigrateTestListener(['Feature'], false);
        PHPMockery::mock('Softonic\DatabaseMigrateTestListener', 'chdir')
            ->once();
        PHPMockery::mock('Softonic\DatabaseMigrateTestListener', 'shell_exec')
            ->with('php artisan migrate:refresh --database sqlite ')
            ->once();
        $testSuite = new TestSuite();
        $testSuite->setName('Feature');
        $listener->startTestSuite($testSuite);
    }

    public function testMigrateCommandHasBeenExecutedSeedingData()
    {
        $listener = new DatabaseMigrateTestListener(['Feature'], true);
        PHPMockery::mock('Softonic\DatabaseMigrateTestListener', 'shell_exec')
            ->with('php artisan migrate:refresh --database sqlite --seed')
            ->once();
        $testSuite = new TestSuite();
        $testSuite->setName('Feature');
        $listener->startTestSuite($testSuite);
    }

    public function testMigrateCommandHasBeenExecutedOnSpecifiedConnection()
    {
        $listener = new DatabaseMigrateTestListener(['Feature'], false, 'testing');
        PHPMockery::mock('Softonic\DatabaseMigrateTestListener', 'shell_exec')
            ->with('php artisan migrate:refresh --database testing ')
            ->once();
        $testSuite = new TestSuite();
        $testSuite->setName('Feature');
        $listener->startTestSuite($testSuite);
    }

    public function testMigrateCommandHasNotBeenExecutedWhenTestSuiteDontMatches()
    {
        $listener = new DatabaseMigrateTestListener(['Feature'], false);
        PHPMockery::mock('Softonic\DatabaseMigrateTestListener', 'chdir')->never();
        PHPMockery::mock('Softonic\DatabaseMigrateTestListener', 'shell_exec')->never();
        $testSuite = new TestSuite();
        $testSuite->setName('Unit');
        $listener->startTestSuite($testSuite);
    }

    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }
}
