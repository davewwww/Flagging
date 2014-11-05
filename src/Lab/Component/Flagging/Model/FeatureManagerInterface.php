<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
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