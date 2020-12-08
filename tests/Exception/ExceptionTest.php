<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Whereby\Exception\WherebyException;
/**
 * @file
 * PHPUnit tests for Exception.
 */

class ExceptionTest extends TestCase {

    public function testToString() {
        $exception = new WherebyException('error', '500');
        $this->assertEquals("Whereby\Exception\WherebyException: [500]: error\n", $exception->__toString());
    }

}
