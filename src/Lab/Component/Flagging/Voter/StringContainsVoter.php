<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Context\Context;
use Lab\Component\Flagging\Delegator\EntriesDelegatorInterface;

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
    public function vote($config, Context $context)
    {
        if (is_scalar($config)) {
            $config = array($config);
        }

        return $this->delegator->delegate(
            $config,
            function ($entry) use ($context) {
                return false !== strpos($this->string, $entry);
            }
        );
    }
}
