<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Delegator\AndEntriesDelegator;
use Lab\Component\Flagging\Delegator\EntryDelegator;
use Lab\Component\Flagging\Delegator\OrEntriesDelegator;

class EntriesDelegatorTest extends \PHPUnit_Framework_TestCase
{
    public function testOrDelegator()
    {
        $strategy = new OrEntriesDelegator(new EntryDelegator());

        $closureIsFoo = function ($foo) {
            return $foo === "foo";
        };

        $this->assertTrue($strategy->delegate(array("foo"), $closureIsFoo));
        $this->assertTrue($strategy->delegate(array("bar", "foo"), $closureIsFoo));

        $this->assertFalse($strategy->delegate(array("bar"), $closureIsFoo));
        $this->assertFalse($strategy->delegate(array("bar", "lorem"), $closureIsFoo));
    }

    public function testAndDelegator()
    {
        $strategy = new AndEntriesDelegator(new EntryDelegator());

        $closureIsFooAndBar = function ($foo) {
            return in_array($foo, array("foo", "bar"));
        };

        $this->assertTrue($strategy->delegate(array("foo"), $closureIsFooAndBar));
        $this->assertTrue($strategy->delegate(array("bar"), $closureIsFooAndBar));
        $this->assertTrue($strategy->delegate(array("bar", "foo"), $closureIsFooAndBar));
        $this->assertTrue($strategy->delegate(array("foo", "bar"), $closureIsFooAndBar));

        $this->assertFalse($strategy->delegate(array("lorem"), $closureIsFooAndBar));
        $this->assertFalse($strategy->delegate(array("foo", "bar", "lorem"), $closureIsFooAndBar));
    }
}