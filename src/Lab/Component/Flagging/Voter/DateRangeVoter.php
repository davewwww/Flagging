<?php

namespace Lab\Component\Flagging\Voter;

use DateTime;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class DateRangeVoter implements VoterInterface
{
    const NAME = 'date_range';

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return static::NAME;
    }

    /**
     * :TODO: use Comparison
     * :TODO: check if already date obj
     * {@inheritDoc}
     */
    public function vote($config, VoteContext $token)
    {
        $now = new DateTime();

        if (isset($config["from"]) && isset($config["to"])) {
            return new DateTime($config["from"]) <= $now && new DateTime($config["to"]) >= $now;
        }

        if (isset($config["from"])) {
            return new DateTime($config["from"]) <= $now;
        }

        if (isset($config["to"])) {
            return new DateTime($config["to"]) >= $now;
        }

        return false;
    }
}
