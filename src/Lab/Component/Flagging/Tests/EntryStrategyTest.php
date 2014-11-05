<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Strategie\DecideEntryStrategy;
use Lab\Component\Flagging\Strategie\NegationEntryStrategy;

class EntryStrategy extends \PHPUnit_Framework_TestCase
{
    public function testDecideEntryStrategy()
    {
        $strategy = new DecideEntryStrategy();

        $closureIsFoo = function ($foo) {
            return $foo === "foo";
        };
        $closureIsNotFoo = function ($foo) {
            return $foo !== "foo";
        };

        $this->assertTrue($strategy->decide("foo", $closureIsFoo));
        $this->assertTrue($strategy->decide("bar", $closureIsNotFoo));
        $this->assertTrue($strategy->decide("!bar", $closureIsNotFoo));

        $this->assertFalse($strategy->decide("!foo", $closureIsFoo));
        $this->assertFalse($strategy->decide("bar", $closureIsFoo));
    }

    public function testNegationEntryStrategy()
    {
        $strategy = new NegationEntryStrategy();

        $closureIsFoo = function ($foo) {
            return $foo === "foo";
        };
        $closureIsNotFoo = function ($foo) {
            return $foo !== "foo";
        };

        $this->assertTrue($strategy->decide("!foo", $closureIsNotFoo));
        $this->assertTrue($strategy->decide("bar", $closureIsNotFoo));
        $this->assertTrue($strategy->decide("foo", $closureIsFoo));
        $this->assertTrue($strategy->decide("!bar", $closureIsFoo));

        $this->assertFalse($strategy->decide("bar", $closureIsFoo));
        $this->assertFalse($strategy->decide("!foo", $closureIsFoo));
        $this->assertFalse($strategy->decide("foo", $closureIsNotFoo));
        $this->assertFalse($strategy->decide("!bar", $closureIsNotFoo));
    }
}