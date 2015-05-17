<?php

namespace Dwo\Flagging\Tests;

use Dwo\Flagging\Walker;

class WalkerTest extends \PHPUnit_Framework_TestCase
{
    public function testWalkAndOk()
    {
        $closure = function ($a) {
            return true;
        };

        $result = Walker::walkAnd(array('foo', 'bar'), $closure);

        self::assertTrue($result);
    }

    public function testWalkAndError()
    {
        $closure = function ($a) {
            return $a !== 'bar';
        };

        $result = Walker::walkAnd(array('foo', 'bar'), $closure);

        self::assertFalse($result);
    }

    public function testWalkOrOk()
    {
        $closure = function ($a) {
            return true;
        };

        $result = \Dwo\Flagging\Walker::walkOr(array('foo', 'bar'), $closure);

        self::assertTrue($result);
    }

    public function testWalkOrOkButFirstWasError()
    {
        $closure = function ($a) {
            return $a !== 'foo';
        };

        $result = Walker::walkOr(array('foo', 'bar'), $closure);

        self::assertTrue($result);
    }

    public function testDelegateNegated()
    {
        $closure = function ($arg) {
            self::assertEquals('DE', $arg);
            return true;
        };

        $result = Walker::delegateNegated('!DE', $closure);

        self::assertFalse($result);
    }

    public function testDelegateNegatedWithout()
    {
        $closure = function ($arg) {
            self::assertEquals('DE', $arg);
            return true;
        };

        $result = Walker::delegateNegated('DE', $closure);

        self::assertTrue($result);
    }
}