<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class VersionComparison implements ComparisonInterface
{
    const NAME = "version";

    /**
     * @return \Closure[]
     */
    function getAllComparisons()
    {
        return array(
            self::NAME => function ($a, $b, $operator = null) {
                    return version_compare($a, $b, $operator);
                }
        );
    }

    /**
     * {@inheritDoc}
     */
    function getComparison($key = null)
    {
        return $this->getAllComparisons()[self::NAME];
    }

}
