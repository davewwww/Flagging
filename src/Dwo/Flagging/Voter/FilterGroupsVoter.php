<?php

namespace Dwo\Flagging\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\FilterGroupInterface;
use Dwo\Flagging\Walker;

/**
 * @author David Wolter <david@lovoo.com>
 */
class FilterGroupsVoter
{
    /**
     * @var EntriesAndVoter
     */
    protected $voter;

    /**
     * @param EntriesAndVoter $voter
     */
    public function __construct(EntriesAndVoter $voter)
    {
        $this->voter = $voter;
    }

    /**
     * @param FilterGroupInterface[] $config
     * @param Context                $context
     *
     * @return bool
     */
    public function vote(array $config, Context $context)
    {
        if (!count($config)) {
            return true;
        }

        return Walker::walkOr(
            $config,
            function (FilterGroupInterface $filterGroup) use ($context) {
                return $this->voter->vote($filterGroup->getFilters(), $context);
            },
            true
        );
    }
}
