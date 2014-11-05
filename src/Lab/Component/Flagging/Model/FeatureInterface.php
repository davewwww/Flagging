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
     * @param string $name
     */
    function setName($name);

    /**
     * :TODO: FilterCollectionInterface[]
     *
     * @return array
     */
    function getFilters();

    /**
     * @param array $filters
     */
    function setFilters(array $filters);

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