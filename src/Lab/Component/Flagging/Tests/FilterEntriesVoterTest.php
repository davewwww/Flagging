<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Voter\FilterCollectionEntriesVoter;
use Lab\Component\Flagging\Voter\FilterEntriesVoter;
use Lab\Component\Flagging\Model\Filter;
use Lab\Component\Flagging\Delegator\AndEntriesDelegator;
use Lab\Component\Flagging\Delegator\EntryDelegator;
use Lab\Component\Flagging\Delegator\NegationEntryDelegator;
use Lab\Component\Flagging\Delegator\OrEntriesDelegator;
use Lab\Component\Flagging\Context\Context;
use Lab\Component\Flagging\Voter\FilterVoter;
use Lab\Component\Flagging\Voter\DateRangeVoter;
use Lab\Component\Flagging\Voter\StringContainsVoter;

class FilternEntriesVoterTest extends Fixtures {
    public function testVoteEntriesvoter() {
        $voteEntriesvoter = $this->getFilterEntriesVoter();
        $context = new Context();

        $this->assertTrue($voteEntriesvoter->vote(array(
            new Filter("substr", "foo"),
        ), $context));

        $this->assertFalse($voteEntriesvoter->vote(array(
            new Filter("substr", "lorem"),
        ), $context));

        $this->assertTrue($voteEntriesvoter->vote(array(
            new Filter("substr", "foo"),
            new Filter("date_range", array( "from" => "-1 day", "to" => "+1 day" )),
        ), $context));

        $this->assertFalse($voteEntriesvoter->vote(array(
            new Filter("substr", "foo"),
            new Filter("date_range", array( "from" => "+1 day", "to" => "+2 day" )),
        ), $context));

        $this->assertTrue($voteEntriesvoter->vote(array(
            new Filter("substr", array( "foo" )),
        ), $context));

        $this->assertFalse($voteEntriesvoter->vote(array(
            new Filter("substr", array( "lorem" )),
        ), $context));
    }
}