<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface FeatureManagerInterface
{
    /**
     * @param string $name
     *
     * @return FeatureInterface
     */
    function findFeatureByName($name);

    /**
     * @return FeatureInterface[]
     */
    function findAllFeatures();

    /**
     * @param FeatureInterface $feature
     */
    function saveFeature(FeatureInterface $feature);
}