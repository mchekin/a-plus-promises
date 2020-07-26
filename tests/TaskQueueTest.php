<?php
namespace Mchekin\APlusPromises\Test;

use Mchekin\APlusPromises\TaskQueue;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Mchekin\APlusPromises\TaskQueue
 */
class TaskQueueTest extends TestCase
{
    public function testKnowsIfEmptyWithShutdown()
    {
        $taskQueue = new TaskQueue();

        $this->assertTrue($taskQueue->isEmpty());
    }

    public function testKnowsIfEmpty()
    {
        $taskQueue = new TaskQueue(false);

        $this->assertTrue($taskQueue->isEmpty());
    }

    public function testKnowsIfFull()
    {
        $taskQueue = new TaskQueue(false);

        $taskQueue->add(function () {});

        $this->assertFalse($taskQueue->isEmpty());
    }

    public function testExecutesTasksInOrder()
    {
        $taskQueue = new TaskQueue(false);

        $called = [];

        $taskQueue->add(function () use (&$called) { $called[] = 'a'; });
        $taskQueue->add(function () use (&$called) { $called[] = 'b'; });
        $taskQueue->add(function () use (&$called) { $called[] = 'c'; });

        $taskQueue->run();

        $this->assertEquals(['a', 'b', 'c'], $called);
    }
}
