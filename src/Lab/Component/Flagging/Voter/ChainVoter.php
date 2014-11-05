<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Strategie\WalkEntriesStrategyInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ChainVoter implements VoterInterface
{
    /**
     * @var WalkEntriesStrategyInterface
     */
    private $walkStrategy;
    /**
     * @var VoterInterface[]
     */
    private $voters;
    /**
     * @var string
     */
    private $name;

    /**
     * @param WalkEntriesStrategyInterface $walkStrategy
     * @param VoterInterface[]             $voters
     * @param string                       $name
     */
    public function __construct(WalkEntriesStrategyInterface $walkStrategy, array $voters, $name)
    {
        $this->walkStrategy = $walkStrategy;
        $this->voters = $voters;
        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function vote($config, VoteContext $token)
    {
        return $this->walkStrategy->walk($this->voters, function (VoterInterface $voter) use ($config, $token) {
            return $voter->vote($config, $token);
        });
    }
}
