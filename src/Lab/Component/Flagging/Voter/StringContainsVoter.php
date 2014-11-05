<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Strategie\WalkEntriesStrategyInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class StringContainsVoter implements VoterInterface
{
    /**
     * @var WalkEntriesStrategyInterface
     */
    protected $orWalker;

    /**
     * @var string
     */
    protected $string;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param WalkEntriesStrategyInterface $walker
     * @param string $name
     * @param string $string
     */
    function __construct(WalkEntriesStrategyInterface $walker, $name, $string)
    {
        $this->orWalker = $walker;
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
        $closure = function ($entry) use ($token) {
            return false !== strpos($this->string, $entry);
        };

        return is_array($config) ? $this->orWalker->walk($config, $closure) : $closure($config);
    }
}
