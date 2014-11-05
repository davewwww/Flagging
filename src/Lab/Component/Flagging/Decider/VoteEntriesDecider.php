<?php

namespace Lab\Component\Flagging\Decider;

use Lab\Component\Flagging\Strategie\WalkEntriesStrategyInterface;
use Lab\Component\Flagging\VoteContext;
use Lab\Component\Flagging\Voter\VoterInterface;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @author David Wolter <david@dampfer.net>
 */
class VoteEntriesDecider implements EntriesDeciderInterface
{
    /**
     * @var VoterInterface
     */
    protected $voter;

    /**
     * @var WalkEntriesStrategyInterface
     */
    protected $walkStrategy;

    /**
     * @param VoterInterface $voter
     * @param WalkEntriesStrategyInterface $walkStrategy
     */
    function __construct(VoterInterface $voter, WalkEntriesStrategyInterface $walkStrategy)
    {
        $this->voter = $voter;
        $this->walkStrategy = $walkStrategy;
    }

    /**
     * @param array $entries
     * @param VoteContext $token
     *
     * @return bool
     */
    public function decide(array $entries, VoteContext $token)
    {
        return $this->walkStrategy->walk($entries, function ($entry) use ($token) {
            return $this->voter->vote($entry, $token);
        });
    }
}
