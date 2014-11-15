<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Delegator\EntriesDelegatorInterface;
use Lab\Component\Flagging\FeatureDeciderInterface;
use Lab\Component\Flagging\Context\Context;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FeatureVoter implements VoterInterface
{
    /**
     * @var EntriesDelegatorInterface
     */
    protected $entriesDelegator;

    /**
     * @var FeatureDeciderInterface
     */
    protected $featureDecider;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param EntriesDelegatorInterface $entriesDelegator
     * @param FeatureDeciderInterface   $featureDecider
     * @param string                    $name
     */
    function __construct(EntriesDelegatorInterface $entriesDelegator, FeatureDeciderInterface $featureDecider, $name)
    {

        $this->entriesDelegator = $entriesDelegator;
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
    public function vote($config, Context $context)
    {
        if (is_scalar($config)) {
            $config = array($config);
        }

        return $this->entriesDelegator->delegate(
            $config,
            function ($featureName) use ($context) {
                $featureNameOrigin = $context->getName();
                $context->setName($featureName);

                $result = $this->featureDecider->decide($featureName, $context, false);

                $context->setName($featureNameOrigin);

                return $result;
            }
        );
    }
}
