<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Decider\FilterDecider;
use Lab\Component\Flagging\Decider\VoteEntriesDecider;
use Lab\Component\Flagging\Model\Filter;
use Lab\Component\Flagging\Strategie\AndWalkEntriesStrategy;
use Lab\Component\Flagging\Strategie\DecideEntryStrategy;
use Lab\Component\Flagging\Strategie\NegationEntryStrategy;
use Lab\Component\Flagging\Strategie\OrWalkEntriesStrategy;
use Lab\Component\Flagging\VoteContext;
use Lab\Component\Flagging\Voter\ContainerVoter;
use Lab\Component\Flagging\Voter\DateRangeVoter;
use Lab\Component\Flagging\Voter\StringContainsVoter;

class DeciderTest extends \PHPUnit_Framework_TestCase
{
    public function testVoteEntriesDecider()
    {
        $voteEntriesDecider = $this->getVoteEntriesDecider();
        $context = new VoteContext();

        $this->assertTrue($voteEntriesDecider->decide(array(
            array("voter" => "substr", "config" => "foo"),
        ), $context));

        $this->assertFalse($voteEntriesDecider->decide(array(
            array("voter" => "substr", "config" => "lorem"),
        ), $context));

        $this->assertTrue($voteEntriesDecider->decide(array(
            array("voter" => "substr", "config" => "foo"),
            array("voter" => "date_range", "config" => array("from" => "-1 day", "to" => "+1 day")),
        ), $context));

        $this->assertFalse($voteEntriesDecider->decide(array(
            array("voter" => "substr", "config" => "foo"),
            array("voter" => "date_range", "config" => array("from" => "+1 day", "to" => "+2 day")),
        ), $context));

        $this->assertTrue($voteEntriesDecider->decide(array(
            new Filter("substr", array("foo"))
        ), $context));

        $this->assertFalse($voteEntriesDecider->decide(array(
            new Filter("substr", array("lorem"))
        ), $context));
    }

    public function testFilterDecider()
    {
        $filterDecider = new FilterDecider(new OrWalkEntriesStrategy(new DecideEntryStrategy()), $this->getVoteEntriesDecider());
        $context = new VoteContext();

        $this->assertTrue($filterDecider->decide(array(
            array(
                array("voter" => "substr", "config" => "lorem"),
            ),
            array(
                array("voter" => "substr", "config" => "foo"),
            )
        ), $context));

        $this->assertTrue($filterDecider->decide(array(
            array(
                array("voter" => "substr", "config" => "lorem"),
            ),
            array(
                array("voter" => "substr", "config" => "foo"),
                array("voter" => "date_range", "config" => array("from" => "-1 day", "to" => "+1 day")),
            )
        ), $context));

        $this->assertFalse($filterDecider->decide(array(
            array(
                array("voter" => "substr", "config" => "lorem"),
            ),
            array(
                array("voter" => "substr", "config" => "ipsum"),
            )
        ), $context));

        $this->assertFalse($filterDecider->decide(array(
            array(
                array("voter" => "substr", "config" => "lorem"),
            ),
            array(
                array("voter" => "substr", "config" => "foo"),
                array("voter" => "date_range", "config" => array("from" => "+1 day", "to" => "+2 day")),
            )
        ), $context));
    }

    private function getVoteEntriesDecider()
    {
        return new VoteEntriesDecider($this->getContainerVoter(), new AndWalkEntriesStrategy(new DecideEntryStrategy()));
    }

    private function getContainerVoter()
    {
        return new ContainerVoter(array(
            "substr" => new StringContainsVoter(new OrWalkEntriesStrategy(new NegationEntryStrategy()), "substr", "foo bar"),
            "date_range" => new DateRangeVoter(),
        ));
    }
}