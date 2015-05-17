<?php

namespace Dwo\Flagging\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\FilterBagInterface;

/**
 * @author David Wolter <david@lovoo.com>
 */
class FilterBagVoter
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
     * @param FilterBagInterface $filterBag
     * @param Context            $context
     *
     * @return bool
     */
    public function vote(FilterBagInterface $filterBag, Context $context)
    {
        return $filterBag->hasFilter() ? $this->voter->vote($filterBag->getFilterGroups(), $context) : true;
    }
}
