<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Strategie\AndWalkEntriesStrategy;
use Lab\Component\Flagging\Strategie\DecideEntryStrategy;
use Lab\Component\Flagging\Strategie\OrWalkEntriesStrategy;

class WalkStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testOrWalkEntriesStrategy()
    {
        $strategy = new OrWalkEntriesStrategy(new DecideEntryStrategy());

        $closureIsFoo = function ($foo) {
            return $foo === "foo";
        };

        $this->assertTrue($strategy->walk(array("foo"), $closureIsFoo));
        $this->assertTrue($strategy->walk(array("bar", "foo"), $closureIsFoo));

        $this->assertFalse($strategy->walk(array("bar"), $closureIsFoo));
        $this->assertFalse($strategy->walk(array("bar", "lorem"), $closureIsFoo));
    }

    public function testAndWalkEntriesStrategy()
    {
        $strategy = new AndWalkEntriesStrategy(new DecideEntryStrategy());

        $closureIsFooAndBar = function ($foo) {
            return in_array($foo, array("foo", "bar"));
        };

        $this->assertTrue($strategy->walk(array("foo"), $closureIsFooAndBar));
        $this->assertTrue($strategy->walk(array("bar"), $closureIsFooAndBar));
        $this->assertTrue($strategy->walk(array("bar", "foo"), $closureIsFooAndBar));
        $this->assertTrue($strategy->walk(array("foo", "bar"), $closureIsFooAndBar));

        $this->assertFalse($strategy->walk(array("lorem"), $closureIsFooAndBar));
        $this->assertFalse($strategy->walk(array("foo", "bar", "lorem"), $closureIsFooAndBar));
    }
}