<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Delegator\AndEntriesDelegator;
use Lab\Component\Flagging\Delegator\EntryDelegator;
use Lab\Component\Flagging\Delegator\NegationEntryDelegator;
use Lab\Component\Flagging\Delegator\OrEntriesDelegator;
use Lab\Component\Flagging\FeatureDecider;
use Lab\Component\Flagging\FeatureDeciderInterface;
use Lab\Component\Flagging\Model\FeatureManagerInterface;
use Lab\Component\Flagging\ValueDecider;
use Lab\Component\Flagging\Voter\CachedFilterVoter;
use Lab\Component\Flagging\Voter\DateRangeVoter;
use Lab\Component\Flagging\Voter\DisabledVoter;
use Lab\Component\Flagging\Voter\FilterCollectionEntriesVoter;
use Lab\Component\Flagging\Voter\FilterEntriesVoter;
use Lab\Component\Flagging\Voter\FilterVoter;
use Lab\Component\Flagging\Voter\StringContainsVoter;
use Lab\Component\Flagging\Voter\VoterInterface;

abstract class Fixtures extends \PHPUnit_Framework_TestCase
{

    /**
     * @return FeatureDeciderInterface
     */
    protected function getFeatureDecider()
    {
        return new FeatureDecider($this->getFeatureManager(), $this->getFilterCollectionEntriesVoter());
    }

    /**
     * @return FeatureDeciderInterface
     */
    protected function getValueDecider()
    {
        return new ValueDecider($this->getFeatureManager(), $this->getFilterCollectionEntriesVoter());
    }

    /**
     * @return FeatureManagerInterface
     */
    protected function getFeatureManager()
    {
        return $this->getMock('Lab\Component\Flagging\Model\FeatureManagerInterface');
    }

    /**
     * @return VoterInterface
     */
    protected function getFilterCollectionEntriesVoter()
    {
        return new FilterCollectionEntriesVoter(
            new OrEntriesDelegator(new EntryDelegator()),
            $this->getFilterEntriesVoter()
        );
    }

    /**
     * @return VoterInterface
     */
    protected function getFilterEntriesVoter()
    {
        return new FilterEntriesVoter($this->getCachedFilterVoter(), new AndEntriesDelegator(new EntryDelegator()));
    }

    /**
     * @return VoterInterface
     */
    protected function getFilterVoter()
    {
        return new FilterVoter((array) $this->getFilters());
    }

    /**
     * @return VoterInterface
     */
    protected function getCachedFilterVoter()
    {
        return new CachedFilterVoter($this->getFilterVoter());
    }

    /**
     * @return VoterInterface[]
     */
    protected function getFilters()
    {
        return array(
            "substr"     => new StringContainsVoter(
                    new OrEntriesDelegator(new NegationEntryDelegator()),
                    "substr",
                    "foo bar"
                ),
            "date_range" => new DateRangeVoter(),
            "disabled"   => new DisabledVoter(),
        );
    }
}