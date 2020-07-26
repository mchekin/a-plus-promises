<?php
namespace Mchekin\APlusPromises\Tests;

use Mchekin\APlusPromises\AggregateException;
use PHPUnit\Framework\TestCase;

class AggregateExceptionTest extends TestCase
{
    public function testHasReason()
    {
        $reasons = ['baz', 'bar'];

        $e = new AggregateException('foo', $reasons);

        $this->assertContains('foo; ' . count($reasons) . ' rejected promises', $e->getMessage());
        $this->assertEquals($reasons, $e->getReason());
    }
}
