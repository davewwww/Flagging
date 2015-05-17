<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
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