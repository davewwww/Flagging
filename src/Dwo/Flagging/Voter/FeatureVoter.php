<?php

namespace Dwo\Flagging\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FeatureInterface;

/**
 * @author David Wolter <david@lovoo.com>
 */
class FeatureVoter
{
    /**
     * @var FilterGroupsVoter
     */
    protected $voter;

    /**
     * @param FilterGroupsVoter $voter
     */
    public function __construct(FilterGroupsVoter $voter)
    {
        $this->voter = $voter;
    }

    /**
     * @param FeatureInterface|Feature $feature
     * @param Context                  $context
     *
     * @return bool
     */
    public function vote(FeatureInterface $feature, Context $context)
    {
        if (!$feature->isEnabled()) {
            return false;
        }

        $context->setName($feature->getName());

        $breaker = $feature->getBreaker();
        if ($breaker->hasFilter() && $this->voter->vote($breaker->getFilterGroups(), $context)) {
            return false;
        }

        $filter = $feature->getFilter();

        return $filter->hasFilter() ? $this->voter->vote($filter->getFilterGroups(), $context) : true;
    }
}
