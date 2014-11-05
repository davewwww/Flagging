<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface FeatureInterface
{
    /**
     * @return string
     */
    function getName();

    /**
     * @return FilterInterface[]
     */
    function getFilters();

    /**
     * @return ValueInterface[]
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