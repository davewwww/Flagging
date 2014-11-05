<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Decider\FeatureDecider;
use Lab\Component\Flagging\Decider\FilterDecider;
use Lab\Component\Flagging\Decider\VoteEntriesDecider;
use Lab\Component\Flagging\Model\Feature;
use Lab\Component\Flagging\Model\Filter;
use Lab\Component\Flagging\Strategie\AndWalkEntriesStrategy;
use Lab\Component\Flagging\Strategie\DecideEntryStrategy;
use Lab\Component\Flagging\Strategie\NegationEntryStrategy;
use Lab\Component\Flagging\Strategie\OrWalkEntriesStrategy;
use Lab\Component\Flagging\VoteContext;
use Lab\Component\Flagging\Voter\ContainerVoter;
use Lab\Component\Flagging\Voter\DateRangeVoter;
use Lab\Component\Flagging\Voter\StringContainsVoter;

class FeatureDeciderTest extends \PHPUnit_Framework_TestCase
{
    public function testFeatureDecider()
    {
        $featureDecider = new FeatureDecider($this->getFilterDecider());
        $context = new VoteContext();

        $feature = new Feature("feature", array(
            array(
                new Filter("substr", "foo")
            )
        ));
        $this->assertTrue($featureDecider->decideFeature($feature, $context));

        $feature = new Feature("feature", array(
            array(
                new Filter("substr", "foo"),
                new Filter("date_range", array("from" => "-1 day", "to" => "+2 day")),
            )
        ));
        $this->assertTrue($featureDecider->decideFeature($feature, $context));

        $feature = new Feature("feature", array(
            array(
                new Filter("substr", "lorem"),
            )
        ));
        $this->assertFalse($featureDecider->decideFeature($feature, $context));

        $feature = new Feature("feature", array(
            array(
                new Filter("substr", "lorem"),
            ),
            array(
                new Filter("substr", "foo")
            )
        ));
        $this->assertTrue($featureDecider->decideFeature($feature, $context));

        $feature = new Feature("feature", array(
            array(
                new Filter("substr", "lorem"),
            ),
            array(
                new Filter("substr", "foo"),
                new Filter("date_range", array("from" => "+1 day", "to" => "+2 day")),
            )
        ));
        $this->assertFalse($featureDecider->decideFeature($feature, $context));
    }

    private function getFilterDecider()
    {
        return new FilterDecider(new OrWalkEntriesStrategy(new DecideEntryStrategy()), $this->getVoteEntriesDecider());
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