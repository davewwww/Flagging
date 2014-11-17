<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Exception\FlaggingException;
use Lab\Component\Flagging\Model\FilterInterface;
use Lab\Component\Flagging\Context\Context;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FilterVoter implements VoterInterface
{
    /**
     * @var VoterInterface[]
     */
    protected $voter;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param VoterInterface[] $voter
     * @param string           $name
     */
    function __construct(array $voter, $name = "filter")
    {
        $this->voter = $voter;
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param FilterInterface $config
     * @param Context         $context
     *
     * @return bool
     *
     * @throws FlaggingException
     */
    public function vote($config, Context $context)
    {
        if (!$config instanceof FilterInterface) {
            throw new FlaggingException(
                sprintf('%s parameter must be FilterInterface in %s, %s given', '$config', __CLASS__, gettype($config))
            );
        }

        $voterName = $config->getName();
        $voterConfig = $config->getParameter();

        if (!isset($this->voter[$voterName])) {
            throw new FlaggingException(sprintf("voter '%s' not found in %s", $voterName, __CLASS__));
        }

        return $this->voter[$voterName]->vote($voterConfig, $context);
    }
}
