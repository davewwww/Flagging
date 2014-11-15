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
     * @var EntriesDelegatorInterface
     */
    private $delegator;
    /**
     * @var VoterInterface[]
     */
    private $voters;
    /**
     * @var string
     */
    private $name;

    /**
     * @param EntriesDelegatorInterface $delegator
     * @param VoterInterface[]          $voters
     * @param string                    $name
     */
    public function __construct(EntriesDelegatorInterface $delegator, array $voters, $name)
    {
        $this->delegator = $delegator;
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
        return $this->delegator->delegate(
            $this->voters,
            function (VoterInterface $voter) use ($config, $token) {
                return $voter->vote($config, $token);
            }
        );
    }
}
