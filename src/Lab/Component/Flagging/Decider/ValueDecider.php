<?php

namespace Lab\Component\Flagging\Decider;

use Lab\Component\Flagging\Model\FeatureInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ValueDecider extends AbstractDecider implements FeatureDeciderInterface
{
    /**
     * @var FeatureDeciderInterface
     */
    protected $featureDecider;
    /**
     * @var EntriesDeciderInterface
     */
    protected $filterDecider;

    /**
     * @param FeatureInterface $feature
     * @param VoteContext      $context
     * @param mixed            $default
     *
     * @return mixed
     */
    public function decideFeature(FeatureInterface $feature, VoteContext $context, $default = null)
    {
        if ($this->featureDecider->decideFeature($feature, $context)) {
            foreach ($feature->getValues() as $key => $value) {
                $context->setName($feature->getName()."_".$key);

                if ($this->filterDecider->decide($value->getFilters(), $context)) {
                    return $value->getValue();
                }
            }
        }

        return $default;
    }

}
