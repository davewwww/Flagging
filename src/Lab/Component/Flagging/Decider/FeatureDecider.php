<?php

namespace Lab\Component\Flagging\Decider;

use Lab\Component\Flagging\Model\FeatureInterface;
use Lab\Component\Flagging\VoteContext;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FeatureDecider extends AbstractDecider implements FeatureDeciderInterface
{
    /**
     * @var EntriesDeciderInterface
     */
    protected $filterDecider;

    /**
     * @param FeatureInterface $feature
     * @param VoteContext      $context
     * @param mixed            $default
     *
     * @return bool
     */
    public function decideFeature(FeatureInterface $feature, VoteContext $context, $default = null)
    {
        if (!$feature->isEnabled()) {
            return false;
        }

        $context->setName($feature->getName());
        $this->checkParameter($context, $feature->getRequiredParameters());

        return $this->filterDecider->decide($feature->getFilters(), $context);
    }

    /**
     * @param VoteContext $token
     * @param array       $required
     *
     * @throws \Exception
     */
    protected function checkParameter(VoteContext $token, array $required)
    {
        if (count($required)) {
            if (count($diff = array_diff($required, array_merge(array("user"), array_keys($token->getParams()))))) {
                throw new \Exception(sprintf("expect for feature '%s' this parameters: %s", $token->getName(), implode(", ", $diff)));
            }
        }
    }
}
