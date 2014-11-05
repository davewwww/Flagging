<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ContainerVoter implements VoterInterface
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var VoterInterface[]
     */
    protected $voterContainer;

    /**
     * @param string           $name
     * @param VoterInterface[] $voterContainer
     */
    function __construct($name, $voterContainer)
    {
        $this->name = $name;
        $this->voterContainer = $voterContainer;
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
        $voterName = key($entry);
        $voterConfig = current($entry);

        return $this->voterContainer[$voterName]->vote($voterConfig, $token);
    }
}
