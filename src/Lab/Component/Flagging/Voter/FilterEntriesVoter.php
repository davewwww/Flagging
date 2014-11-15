<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Context\Context;
use Lab\Component\Flagging\Delegator\EntriesDelegatorInterface;
use Lab\Component\Flagging\Model\FilterInterface;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FilterEntriesVoter implements VoterInterface
{
    const NAME = "filter";

    /**
     * @var VoterInterface
     */
    protected $filterVoter;

    /**
     * @var EntriesDelegatorInterface
     */
    protected $entriesDelegator;

    /**
     * @param VoterInterface            $filterVoter
     * @param EntriesDelegatorInterface $entriesDelegator
     */
    function __construct(VoterInterface $filterVoter, EntriesDelegatorInterface $entriesDelegator)
    {
        $this->filterVoter = $filterVoter;
        $this->entriesDelegator = $entriesDelegator;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @param FilterInterface[] $config
     * @param Context           $context
     *
     * @return bool
     */
    public function vote($config, Context $context)
    {
        return $this->entriesDelegator->delegate(
            $config,
            function (FilterInterface $filter) use ($context) {
                return $this->filterVoter->vote($filter, $context);
            }
        );
    }
}
