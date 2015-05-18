<?php

namespace Dwo\Flagging;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FeatureManagerInterface;
use Dwo\Flagging\Voter\FilterGroupsVoter;

/**
 * @author David Wolter <david@lovoo.com>
 */
class ValueDecider implements FeatureDeciderInterface
{
    /**
     * @var FeatureManagerInterface
     */
    protected $featureManager;
    /**
     * @var FeatureDecider
     */
    protected $featureDecider;
    /**
     * @var FilterGroupsVoter
     */
    protected $voter;

    /**
     * @param FeatureManagerInterface $featureManager
     * @param FeatureDecider          $featureDecider
     * @param FilterGroupsVoter       $voter
     */
    public function __construct(
        FeatureManagerInterface $featureManager,
        FeatureDecider $featureDecider,
        FilterGroupsVoter $voter
    ) {
        $this->featureManager = $featureManager;
        $this->featureDecider = $featureDecider;
        $this->voter = $voter;
    }

    /**
     * {@inheritdoc}
     */
    public function decideFeature(Feature $feature, Context $context, $default = null)
    {
        if ($this->featureDecider->decideFeature($feature, $context, $default)) {

            foreach ($feature->getValue()->getValues() as $key => $value) {

                /**
                 * :TODO: why name?
                 */
                $context->setName($feature->getName().'_'.$key);

                $filter = $value->getFilter();
                if ($filter->hasFilter() ? $this->voter->vote($filter->getFilterGroups(), $context) : true) {
                    return $value->getValue();
                }
            }
        }

        return $default;
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
}
