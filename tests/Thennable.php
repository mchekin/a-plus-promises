<?php
namespace Mchekin\APlusPromises\Tests;

use Mchekin\APlusPromises\Promise;

class Thennable
{
    private $nextPromise = null;

    public function __construct()
    {
        $this->nextPromise = new Promise();
    }

    public function then(callable $res = null, callable $rej = null)
    {
        return $this->nextPromise->then($res, $rej);
    }

    public function resolve($value)
    {
        $this->nextPromise->resolve($value);
    }
}
