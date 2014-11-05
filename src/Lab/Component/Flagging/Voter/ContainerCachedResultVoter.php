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
    protected $voter;

    /**
     * @param string         $name
     * @param VoterInterface $voter
     */
    function __construct($name, $voter)
    {
        $this->name = $name;
        $this->voter = $voter;
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
            $result = $this->voter->vote($config, $token);

            $token->setResult($resultId, $result);
        }

        return $result;
    }
}
