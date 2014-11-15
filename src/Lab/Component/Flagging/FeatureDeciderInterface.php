<?php

namespace Lab\Component\Flagging;

use Lab\Component\Flagging\Context\Context;
use Lab\Component\Flagging\Model\FeatureInterface;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface FeatureDeciderInterface
{
    /**
     * @param string      $name
     * @param Context $context
     * @param mixed|null  $default
     *
     * @return mixed
     */
    function decide($name, Context $context, $default = null);

    /**
     * @param FeatureInterface $feature
     * @param Context      $context
     * @param mixed|null       $default
     *
     * @return mixed
     */
    function decideFeature(FeatureInterface $feature, Context $context, $default = null);

}
