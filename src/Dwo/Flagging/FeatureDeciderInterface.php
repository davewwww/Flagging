<?php

namespace Dwo\Flagging;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\Feature;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface FeatureDeciderInterface
{
    /**
     * @param string     $name
     * @param Context    $context
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function decide($name, Context $context, $default = null);

    /**
     * @param Feature    $feature
     * @param Context    $context
     *
     * @return mixed
     */
    public function decideFeature(Feature $feature, Context $context);
}
