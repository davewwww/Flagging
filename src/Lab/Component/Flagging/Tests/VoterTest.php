<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Delegator\EntryDelegator;
use Lab\Component\Flagging\Delegator\NegationEntryDelegator;
use Lab\Component\Flagging\Delegator\OrEntriesDelegator;
use Lab\Component\Flagging\VoteContext;
use Lab\Component\Flagging\Voter\ChainVoter;
use Lab\Component\Flagging\Voter\DateRangeVoter;
use Lab\Component\Flagging\Voter\DisabledVoter;
use Lab\Component\Flagging\Voter\RandomVoter;
use Lab\Component\Flagging\Voter\StringContainsVoter;

class VoterTest extends \PHPUnit_Framework_TestCase
{

    public function testStringContainsVoter()
    {
        $string = "lorem ipsum";
        $voter = new StringContainsVoter(new OrEntriesDelegator(new NegationEntryDelegator()), "string", $string);
        $context = new VoteContext();

        $this->assertTrue($voter->vote(array("lorem"), $context));
        $this->assertTrue($voter->vote(array("lorem", "ipsum"), $context));
        $this->assertTrue($voter->vote(array("lorem", "foo"), $context));

        $this->assertFalse($voter->vote(array("foo"), $context));
        $this->assertFalse($voter->vote(array("foo", "bar"), $context));

        $this->assertTrue($voter->vote(array("!foo"), $context));
    }

    public function testDateRangeVoter()
    {
        $voter = new DateRangeVoter();
        $context = new VoteContext();

        $this->assertTrue($voter->vote(array("from" => "-1 day", "to" => "+1 day"), $context));
        $this->assertTrue($voter->vote(array("from" => "-1 day"), $context));
        $this->assertTrue($voter->vote(array("to" => "+1 day"), $context));

        $this->assertFalse($voter->vote(array("from" => "-2 day", "to" => "-1 day"), $context));
        $this->assertFalse($voter->vote(array("from" => "+1 day", "to" => "+2 day"), $context));
        $this->assertFalse($voter->vote(array("from" => "+1 day"), $context));
        $this->assertFalse($voter->vote(array("to" => "-2 day"), $context));
    }

    public function testDisabledVoter()
    {
        $voter = new DisabledVoter();
        $context = new VoteContext();

        $this->assertFalse($voter->vote(null, $context));
    }

    public function testRandomVoter()
    {
        $voter = new RandomVoter();
        $context = new VoteContext();

        $result = $voter->vote(null, $context);
        $this->assertTrue($result == true || $result == false);
    }

    public function testChainVoter()
    {
        $voter1 = new StringContainsVoter(new OrEntriesDelegator(new NegationEntryDelegator()), "string", "lorem ipsum");
        $voter2 = new StringContainsVoter(new OrEntriesDelegator(new NegationEntryDelegator()), "string", "foo bar");
        $voter = new ChainVoter(new OrEntriesDelegator(new EntryDelegator()), array($voter1, $voter2), "loremfoobar");

        $context = new VoteContext();

        $this->assertTrue($voter->vote(array("lorem"), $context));
        $this->assertTrue($voter->vote(array("lorem", "ipsum"), $context));
        $this->assertTrue($voter->vote(array("lorem", "foo"), $context));
        $this->assertTrue($voter->vote(array("foo"), $context));
        $this->assertTrue($voter->vote(array("foo", "bar"), $context));
        $this->assertTrue($voter->vote(array("foo", "lorem", "ipsum", "bar"), $context));

        $this->assertFalse($voter->vote(array("qwerty"), $context));
    }
}