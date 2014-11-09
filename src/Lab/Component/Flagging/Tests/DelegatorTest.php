<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Delegator\EntryDelegator;
use Lab\Component\Flagging\Delegator\NegationEntryDelegator;

class DelegatorTest extends \PHPUnit_Framework_TestCase
{
    public function testDecideEntryStrategy()
    {
        $delegator = new EntryDelegator();

        $closureIsFoo = function ($foo) {
            return $foo === "foo";
        };

        $this->assertTrue($delegator->delegate("foo", $closureIsFoo));
        $this->assertFalse($delegator->delegate("bar", $closureIsFoo));
    }

    public function testNegationEntryStrategy()
    {
        $strategy = new NegationEntryDelegator();

        $closureIsFoo = function ($foo) {
            return $foo === "foo";
        };

        $this->assertTrue($strategy->delegate("foo", $closureIsFoo));
        $this->assertTrue($strategy->delegate("!bar", $closureIsFoo));

        $this->assertFalse($strategy->delegate("bar", $closureIsFoo));
        $this->assertFalse($strategy->delegate("!foo", $closureIsFoo));
    }
}