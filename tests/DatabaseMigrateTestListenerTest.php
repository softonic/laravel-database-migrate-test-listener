<?php

namespace Softonic\DatabaseMigrateTestListener\Tests;

use Mockery;
use phpmock\mockery\PHPMockery;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestSuite;
use Softonic\DatabaseMigrateTestListener\DatabaseMigrateTestListener;

class DatabaseMigrateTestListenerTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function testConstructor()
    {
        $listener = new DatabaseMigrateTestListener('Feature');
        $this->assertEquals(['Feature'], $listener->testSuites);

        $listener = new DatabaseMigrateTestListener('Feature', 'Integration');
        $this->assertEquals(['Feature', 'Integration'], $listener->testSuites);
    }

    public function testMigrateCommandHasBeenExecutedWhenTestSuiteMatches()
    {
        $listener = new DatabaseMigrateTestListener('Feature');
        PHPMockery::mock('Softonic\DatabaseMigrateTestListener', 'chdir')
            ->once();
        PHPMockery::mock('Softonic\DatabaseMigrateTestListener', 'shell_exec')
            ->with('php artisan migrate:refresh --seed')
            ->once();
        $testSuite = new TestSuite();
        $testSuite->setName('Feature');
        $listener->startTestSuite($testSuite);
    }

    public function testMigrateCommandHasNotBeenExecutedWhenTestSuiteDontMatches()
    {
        $listener = new DatabaseMigrateTestListener('Feature');
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
