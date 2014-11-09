<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Model\FilterInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FilterVoter implements VoterInterface {

    /**
     * @var VoterInterface[]
     */
    protected $voter;

    /**
     * @param VoterInterface[] $voter
     */
    function __construct($voter) {
        $this->voter = $voter;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return "filter";
    }

    /**
     * @param FilterInterface $config
     * @param VoteContext $token
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function vote($config, VoteContext $token) {
        if( !$config instanceof FilterInterface ) {
            throw new \Exception("need FilterInterface for FilterVoter");
        }
        $voterName = $config->getName();
        $voterConfig = $config->getParameter();

        if( !isset($this->voter[$voterName]) ) {
            throw new \Exception(sprintf("voter '%s' not found"), $voterName);
        }

        return $this->voter[$voterName]->vote($voterConfig, $token);
    }
}
