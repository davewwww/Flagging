<?php

namespace Lab\Component\Flagging\Decider;

use Lab\Component\Flagging\Model\FeatureManagerInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
abstract class AbstractDecider implements FeatureDeciderInterface
{
    /**
     * @var FeatureManagerInterface
     */
    protected $featureManager;

    /**
     * @param string      $name
     * @param VoteContext $context
     * @param mixed       $default
     *
     * @return mixed
     */
    public function decide($name, VoteContext $context, $default = null)
    {
        if (null !== $feature = $this->featureManager->findFeatureByName($name)) {
            return $this->decideFeature($feature, $context, $default);
        }

        return $default;
    }
}
