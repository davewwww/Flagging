<?php

namespace Lab\Component\Flagging\Decider;

use Lab\Component\Flagging\Strategie\WalkEntriesStrategyInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FilterDecider implements EntriesDeciderInterface
{
    /**
     * @var WalkEntriesStrategyInterface
     */
    protected $walkStrategy;

    /**
     * @var EntriesDeciderInterface
     */
    protected $voterDecider;

    /**
     * @param array       $entries
     * @param VoteContext $token
     *
     * @return bool
     */
    public function decide(array $entries, VoteContext $token)
    {
        if (!empty($entries)) {
            return $this->walkStrategy->walk($entries, function ($voters) use ($token) {
                return $this->voterDecider->decide($voters, $token);
            });
        } else {
            return true;
        }
    }
}
