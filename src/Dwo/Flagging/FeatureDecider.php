<?php

namespace Dwo\Flagging;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FeatureManagerInterface;
use Dwo\Flagging\Voter\FeatureVoter;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
class FeatureDecider implements FeatureDeciderInterface
{
    /**
     * @var FeatureManagerInterface
     */
    protected $featureManager;

    /**
     * @var FeatureVoter
     */
    protected $voter;

    /**
     * @param FeatureManagerInterface $featureManager
     * @param FeatureVoter            $voter
     */
    public function __construct(FeatureManagerInterface $featureManager, FeatureVoter $voter)
    {
        $this->featureManager = $featureManager;
        $this->voter = $voter;
    }

    /**
     * {@inheritdoc}
     */
    public function decide($name, Context $context, $default = null)
    {
        if (null !== $feature = $this->featureManager->findFeatureByName($name)) {
            return $this->decideFeature($feature, $context, $default);
        }


        return $default;
    }

    /**
     * {@inheritdoc}
     */
    public function decideFeature(Feature $feature, Context $context, $default = null)
    {
        return $this->voter->vote($feature, $context);
    }
}
