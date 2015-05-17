<?php

namespace Dwo\Flagging;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FeatureManagerInterface;
use Dwo\Flagging\Voter\FeatureVoter;
use Dwo\Flagging\Voter\FilterBagVoter;

/**
 * @author David Wolter <david@lovoo.com>
 */
class ValueDecider extends FeatureDecider implements FeatureDeciderInterface
{
    /**
     * @var FilterBagVoter
     */
    protected $filterBagVoter;

    /**
     * @param FeatureManagerInterface $featureManager
     * @param FeatureVoter            $voter
     * @param FilterBagVoter          $filterBagVoter
     */
    public function __construct(
        FeatureManagerInterface $featureManager,
        FeatureVoter $voter,
        FilterBagVoter $filterBagVoter
    ) {
        parent::__construct($featureManager, $voter);
        $this->filterBagVoter = $filterBagVoter;
    }

    /**
     * {@inheritdoc}
     */
    public function decideFeature(Feature $feature, Context $context, $default = null)
    {
        if (parent::decideFeature($feature, $context, $default)) {
            foreach ($feature->getValue()->getValues() as $key => $value) {

                /**
                 * :TODO: why name?
                 */
                $context->setName($feature->getName().'_'.$key);

                if ($this->filterBagVoter->vote($value->getFilter(), $context)) {
                    return $value->getValue();
                }
            }
        }

        return $default;
    }
}
