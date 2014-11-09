<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface FeatureInterface extends FiltersTraitInterface
{
    /**
     * @return string
     */
    function getName();

    /**
     * @param string $name
     */
    function setName($name);

    /**
     * @return null|ValueInterface[]
     */
    function getValues();

    /**
     * @return array
     */
    function getRequiredParameters();

    /**
     * @return bool
     */
    function isEnabled();
}