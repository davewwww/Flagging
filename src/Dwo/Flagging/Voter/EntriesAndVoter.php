<?php

namespace Dwo\Flagging\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Walker;

/**
 * @author David Wolter <david@lovoo.com>
 */
class EntriesAndVoter implements VoterInterface
{
    /**
     * @var VoterInterface
     */
    protected $voter;

    /**
     * @param VoterInterface $voter
     */
    public function __construct(VoterInterface $voter)
    {
        $this->voter = $voter;
    }

    /**
     * {@inheritdoc}
     */
    public function vote($config, Context $context)
    {
        return Walker::walkAnd(
            $config,
            function ($entry) use ($context) {
                return $this->voter->vote($entry, $context);
            },
            true
        );
    }
}
