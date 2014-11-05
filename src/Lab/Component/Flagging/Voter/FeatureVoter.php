<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Decider\FeatureDeciderInterface;
use Lab\Component\Flagging\Strategie\WalkEntriesStrategyInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FeatureVoter implements VoterInterface
{
    /**
     * @var WalkEntriesStrategyInterface
     */
    protected $andOrWalker;

    /**
     * @var FeatureDeciderInterface
     */
    protected $featureDecider;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param WalkEntriesStrategyInterface $walker
     * @param FeatureDeciderInterface      $featureDecider
     * @param string                       $name
     */
    function __construct(WalkEntriesStrategyInterface $walker, FeatureDeciderInterface $featureDecider, $name)
    {

        $this->andOrWalker = $walker;
        $this->featureDecider = $featureDecider;
        $this->name = $name;
    }

    /**
     * {@inheritDoc}
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
        return $this->andOrWalker->walk($config, function ($featureName) use ($token) {
            $featureNameOrigin = $token->getName();
            $token->setName($featureName);

            $result = $this->featureDecider->decide($featureName, $token, false);

            $token->setName($featureNameOrigin);

            return $result;
        });
    }
}
