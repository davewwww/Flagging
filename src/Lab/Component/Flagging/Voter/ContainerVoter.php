<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Model\FilterInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ContainerVoter implements VoterInterface
{
    /**
     * @var VoterInterface[]
     */
    protected $voterContainer;
    /**
     * @var string
     */
    protected $name;

    /**
     * @param VoterInterface[] $voterContainer
     * @param string $name
     */
    function __construct($voterContainer, $name = "container")
    {
        $this->voterContainer = $voterContainer;
        $this->name = $name;
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
        if($config instanceof FilterInterface) {
            $voterName = $config->getName();
            $voterConfig = $config->getParameter();
        }
        else {
            $voterName = $config["voter"];
            $voterConfig = $config["config"];
        }

        return $this->voterContainer[$voterName]->vote($voterConfig, $token);
    }
}
