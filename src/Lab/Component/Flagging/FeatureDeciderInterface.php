<?php

namespace Lab\Component\Flagging;

use Lab\Component\Flagging\Model\FeatureInterface;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface FeatureDeciderInterface
{
    /**
     * @param string      $name
     * @param VoteContext $context
     * @param mixed|null  $default
     *
     * @return mixed
     */
    function decide($name, VoteContext $context, $default = null);

    /**
     * @param FeatureInterface $feature
     * @param VoteContext      $context
     * @param mixed|null       $default
     *
     * @return mixed
     */
    function decideFeature(FeatureInterface $feature, VoteContext $context, $default = null);

}
