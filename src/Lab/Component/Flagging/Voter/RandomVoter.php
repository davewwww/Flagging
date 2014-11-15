<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Context\Context;

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
    public function vote($config, Context $context)
    {
        return mt_rand(0, 100) <= (int)$config;
    }
}
