<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class DefaultComparison implements ComparisonInterface
{
    const NAME = "default";

    /**
     * @return \Closure[]
     */
    function getAllComparisons()
    {
        return array(
            self::NAME => function ($a, $b) {
                    return is_array($b) ? in_array($a, $b) : $a === $b;
                }
        );
    }

    /**
     * {@inheritDoc}
     */
    function getComparison($key)
    {
        return $this->getAllComparisons()[self::NAME];
    }

}
