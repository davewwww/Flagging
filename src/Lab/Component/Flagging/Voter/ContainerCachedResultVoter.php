<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ContainerCachedResultVoter implements VoterInterface
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var VoterInterface
     */
    protected $containerVoter;

    /**
     * @param string         $name
     * @param VoterInterface $containerVoter
     */
    function __construct($name, $containerVoter)
    {
        $this->name = $name;
        $this->containerVoter = $containerVoter;
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
        $resultId = $token->createResultId($voterName = key($entry));

        if (null === $result = $token->getResult($resultId)) {
            $result = $this->containerVoter->vote($config, $token);

            $token->setResult($resultId, $result);
        }

        return $result;
    }
}
