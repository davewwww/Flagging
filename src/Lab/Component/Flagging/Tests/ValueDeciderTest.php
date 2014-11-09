<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\FeatureDecider;
use Lab\Component\Flagging\Model\FilterCollection;
use Lab\Component\Flagging\Voter\FilterCollectionEntriesVoter;
use Lab\Component\Flagging\ValueDecider;
use Lab\Component\Flagging\Voter\FilterEntriesVoter;
use Lab\Component\Flagging\Model\Feature;
use Lab\Component\Flagging\Model\Filter;
use Lab\Component\Flagging\Model\Value;
use Lab\Component\Flagging\Delegator\AndEntriesDelegator;
use Lab\Component\Flagging\Delegator\EntryDelegator;
use Lab\Component\Flagging\Delegator\NegationEntryDelegator;
use Lab\Component\Flagging\Delegator\OrEntriesDelegator;
use Lab\Component\Flagging\VoteContext;
use Lab\Component\Flagging\Voter\FilterVoter;
use Lab\Component\Flagging\Voter\DateRangeVoter;
use Lab\Component\Flagging\Voter\DisabledVoter;
use Lab\Component\Flagging\Voter\StringContainsVoter;

class ValueDeciderTest extends Fixtures {



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

    public function testFeatureIsDisabled() {
        $context = new VoteContext();
        $feature = new Feature("feature", array( new FilterCollection(array( new Filter("disabled") )) ), array(
            new Value("foo")
        ));
        $this->assertEquals($this->getValueDecider()->decideFeature($feature, $context), null);
    }

    public function testValueThatMatches() {
        $context = new VoteContext();
        $feature = new Feature("feature", null, array(
            new Value("foo", array( new FilterCollection(array( new Filter("disabled") )) )),
            new Value("bar"),
        ));
        $this->assertEquals($this->getValueDecider()->decideFeature($feature, $context), "bar");
    }

    public function testDefaultValueFromDisabledFeature() {
        $context = new VoteContext();
        $feature = new Feature("feature", array( new FilterCollection(array( new Filter("disabled") )) ), array(
            new Value("foo")
        ));
        $this->assertEquals($this->getValueDecider()->decideFeature($feature, $context, "lorem"), "lorem");
    }
}