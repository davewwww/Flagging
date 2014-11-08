<?php

namespace Lab\Component\Flagging\Decider;

use Lab\Component\Flagging\Model\FeatureInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ValueDecider extends AbstractDecider implements FeatureDeciderInterface {
    /**
     * @var FeatureDeciderInterface
     */
    protected $featureDecider;
    /**
     * @var EntriesDeciderInterface
     */
    protected $filterDecider;

    /**
     * @param FeatureDeciderInterface $featureDecider
     * @param EntriesDeciderInterface $filterDecider
     */
    function __construct(FeatureDeciderInterface $featureDecider, EntriesDeciderInterface $filterDecider) {
        $this->featureDecider = $featureDecider;
        $this->filterDecider = $filterDecider;
    }

    /**
     * @param FeatureInterface $feature
     * @param VoteContext $context
     * @param mixed $default
     *
     * @return mixed
     */
    public function decideFeature(FeatureInterface $feature, VoteContext $context, $default = null) {
        if( $this->featureDecider->decideFeature($feature, $context) ) {
            foreach( $feature->getValues() as $key => $value ) {
                $context->setName($feature->getName() . "_" . $key);

                $filters = $value->getFilters();
                if(empty($filters) || $this->filterDecider->decide($filters, $context) ) {
                    return $value->getValue();
                }
            }
        }

        return $default;
    }

}
