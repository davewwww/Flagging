<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Context\Context;

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
    function vote($config, Context $context)
    {
        return false;
    }
}
