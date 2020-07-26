<?php
namespace Mchekin\APlusPromises\Tests;

use Mchekin\APlusPromises\RejectionException;
use PHPUnit\Framework\TestCase;

class Thing1
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function __toString()
    {
        return $this->message;
    }
}

class Thing2 implements \JsonSerializable
{
    public function jsonSerialize()
    {
        return '{}';
    }
}

/**
 * @covers \Mchekin\APlusPromises\RejectionException
 */
class RejectionExceptionTest extends TestCase
{

    public function testCanGetReasonMessageFromDescription()
    {
        $reason = 'Ignored reason';
        $description = 'So rejected!';

        $e = new RejectionException($reason, $description);

        $this->assertContains('The promise was rejected with reason: ' . $description, $e->getMessage());
    }

    public function testCanGetReasonMessageFromString()
    {
        $thing = new Thing1('foo');

        $e = new RejectionException($thing);

        $this->assertSame($thing, $e->getReason());
        $this->assertEquals('The promise was rejected with reason: foo', $e->getMessage());
    }

    public function testCanGetReasonMessageFromJson()
    {
        $reason = new Thing2();

        $e = new RejectionException($reason);

        $this->assertContains('{}', $e->getMessage());
    }
}
