<?php

namespace Lab\Component\Flagging;

use Lab\Component\Flagging\Model\FeatureInterface;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ValueDecider extends FeatureDecider implements FeatureDeciderInterface
{
    /**
     * {@inheritdoc}
     */
    public function decideFeature(FeatureInterface $feature, VoteContext $context, $default = null)
    {
        if (parent::decideFeature($feature, $context)) {
            foreach ($feature->getValues() as $key => $value) {
                $context->setName($feature->getName()."_".$key);
                if ($this->voteFilters($value->getFilters(), $context)) {
                    return $value->getValue();
                }
            }
        }

        return $default;
    }

}
