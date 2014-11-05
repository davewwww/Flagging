<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class RandomVoter implements VoterInterface
{
    const NAME = 'random';

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return static::NAME;
    }

    /**
     * {@inheritDoc}
     */
    public function vote($config, VoteContext $token)
    {
        return mt_rand(0, 100) <= $config;
    }
}
