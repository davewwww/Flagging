<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Context\CachedContext;
use Lab\Component\Flagging\Context\Context;

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
    public function vote($config, Context $context)
    {
        if ($context instanceof CachedContext) {
            $resultId = $context->createResultId($voterName = key($entry));

            if (null === $result = $context->getResult($resultId)) {
                $result = $this->containerVoter->vote($config, $context);

                $context->setResult($resultId, $result);
            }

            return $result;
        }

        return $this->containerVoter->vote($config, $context);
    }
}
