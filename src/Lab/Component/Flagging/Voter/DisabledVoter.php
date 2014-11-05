<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class DisabledVoter implements VoterInterface
{
    const NAME = 'disabled';

    /**
     * {@inheritDoc}
     */
    function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritDoc}
     */
    function vote($config, VoteContext $token)
    {
        return false;
    }
}
