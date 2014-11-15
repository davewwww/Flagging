<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Delegator\EntriesDelegatorInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class StringContainsVoter implements VoterInterface
{
    /**
     * @var EntriesDelegatorInterface
     */
    protected $delegator;

    /**
     * @var string
     */
    protected $string;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param EntriesDelegatorInterface $delegator
     * @param string                    $name
     * @param string                    $string
     */
    function __construct(EntriesDelegatorInterface $delegator, $name, $string)
    {
        $this->delegator = $delegator;
        $this->name = $name;
        $this->string = $string;
    }

    /**
     * @return mixed
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
        if (is_scalar($config)) {
            $config = array($config);
        }

        return $this->delegator->delegate(
            $config,
            function ($entry) use ($token) {
                return false !== strpos($this->string, $entry);
            }
        );
    }
}
