<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Delegator\EntriesDelegatorInterface;
use Lab\Component\Flagging\Model\FilterCollectionInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FilterCollectionEntriesVoter implements VoterInterface {
    /**
     * @var EntriesDelegatorInterface
     */
    protected $entriesDelegator;

    /**
     * @var VoterInterface
     */
    protected $filterEntriesVoter;

    /**
     * @param EntriesDelegatorInterface $entriesDelegator
     * @param VoterInterface $filterEntriesVoter
     */
    function __construct(EntriesDelegatorInterface $entriesDelegator, VoterInterface $filterEntriesVoter) {
        $this->entriesDelegator = $entriesDelegator;
        $this->filterEntriesVoter = $filterEntriesVoter;
    }

    public function getName() {
        return "filter_collection";
    }

    /**
     * @param FilterCollectionInterface[] $config
     * @param VoteContext $token
     *
     * @return bool
     */
    public function vote($config, VoteContext $token) {
        if( !empty($config) ) {
            return $this->entriesDelegator->delegate($config, function (FilterCollectionInterface $filterCollection) use ($token) {
                return $this->filterEntriesVoter->vote($filterCollection->getFilter(), $token);
            });
        } else {
            return true;
        }
    }
}
