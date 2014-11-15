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
     * @param VoterInterface[] $voter
     */
    function __construct(array $voter)
    {
        $this->voter = $voter;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return "filter";
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
            throw new FlaggingException(sprintf('%s parameter must be FilterInterface in %s', '$config', __CLASS__));
        }

        $voterName = $config->getName();
        $voterConfig = $config->getParameter();

        if (!isset($this->voter[$voterName])) {
            throw new FlaggingException(sprintf("voter '%s' not found in %s", $voterName, __CLASS__));
        }

        return $this->voter[$voterName]->vote($voterConfig, $context);
    }
}
