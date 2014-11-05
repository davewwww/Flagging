<?php

namespace Lab\Component\Flagging\Decider;

use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface EntriesDeciderInterface
{
    /**
     * @param array       $entries
     * @param VoteContext $token
     */
    function decide(array $entries, VoteContext $token);
}
