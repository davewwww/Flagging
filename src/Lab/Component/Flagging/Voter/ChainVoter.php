<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Delegator\EntriesDelegatorInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ChainVoter implements VoterInterface
{
    /**
     * @var \Lab\Component\Flagging\Strategie\Walk\EntriesDelegatorInterface
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
     * @param \Lab\Component\Flagging\Delegate\\Lab\Component\Flagging\Delegator\EntriesDelegatorInterface $walkStrategy
     * @param VoterInterface[]             $voters
     * @param string                       $name
     */
    public function __construct(EntriesDelegatorInterface $walkStrategy, array $voters, $name)
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
        return $this->walkStrategy->delegate($this->voters, function (VoterInterface $voter) use ($config, $token) {
            return $voter->vote($config, $token);
        });
    }
}
