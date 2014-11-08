<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Decider\FeatureDecider;
use Lab\Component\Flagging\Decider\FilterDecider;
use Lab\Component\Flagging\Decider\ValueDecider;
use Lab\Component\Flagging\Decider\VoteEntriesDecider;
use Lab\Component\Flagging\Model\Feature;
use Lab\Component\Flagging\Model\Filter;
use Lab\Component\Flagging\Model\Value;
use Lab\Component\Flagging\Strategie\AndWalkEntriesStrategy;
use Lab\Component\Flagging\Strategie\DecideEntryStrategy;
use Lab\Component\Flagging\Strategie\NegationEntryStrategy;
use Lab\Component\Flagging\Strategie\OrWalkEntriesStrategy;
use Lab\Component\Flagging\VoteContext;
use Lab\Component\Flagging\Voter\ContainerVoter;
use Lab\Component\Flagging\Voter\DateRangeVoter;
use Lab\Component\Flagging\Voter\DisabledVoter;
use Lab\Component\Flagging\Voter\StringContainsVoter;

class ValueDeciderTest extends \PHPUnit_Framework_TestCase {

    public function testGetValue() {
        $context = new VoteContext();

        $feature = new Feature("feature", null, array(
            new Value("foo"),
        ));
        $this->assertEquals($this->getValueDecider()->decideFeature($feature, $context), "foo");
    }

    public function testGetFirstValue() {
        $context = new VoteContext();
        $feature = new Feature("feature", null, array(
            new Value("foo"),
            new Value("bar"),
        ));
        $this->assertEquals($this->getValueDecider()->decideFeature($feature, $context), "foo");
    }

    public function testValueThatMatches() {
        $context = new VoteContext();
        $feature = new Feature("feature", null, array(
            new Value("foo", array( array( new Filter("disabled") ) )),
            new Value("bar"),
        ));
        $this->assertEquals($this->getValueDecider()->decideFeature($feature, $context), "bar");
    }

    public function testFeatureIsDisabled() {
        $context = new VoteContext();
        $feature = new Feature("feature", array( array( new Filter("disabled") ) ), array(
            new Value("foo")
        ));
        $this->assertEquals($this->getValueDecider()->decideFeature($feature, $context), null);
    }

    public function testDefaultValueFromDisabledFeature() {
        $context = new VoteContext();
        $feature = new Feature("feature", array( array( new Filter("disabled") ) ), array(
            new Value("foo")
        ));
        $this->assertEquals($this->getValueDecider()->decideFeature($feature, $context, "lorem"), "lorem");
    }

    /**
     * @return ValueDecider
     */
    private function getValueDecider() {
        return new ValueDecider($this->getFeatureDecider(), $this->getFilterDecider());
    }

    private function getFeatureDecider() {
        return new FeatureDecider($this->getFilterDecider());
    }

    private function getFilterDecider() {
        return new FilterDecider(new OrWalkEntriesStrategy(new DecideEntryStrategy()), $this->getVoteEntriesDecider());
    }

    private function getVoteEntriesDecider() {
        return new VoteEntriesDecider($this->getContainerVoter(), new AndWalkEntriesStrategy(new DecideEntryStrategy()));
    }

    private function getContainerVoter() {
        return new ContainerVoter(array(
            "substr" => new StringContainsVoter(new OrWalkEntriesStrategy(new NegationEntryStrategy()), "substr", "foo bar"),
            "date_range" => new DateRangeVoter(),
            "disabled" => new DisabledVoter(),
        ));
    }
}