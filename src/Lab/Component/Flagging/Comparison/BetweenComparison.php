<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class BetweenComparison implements ComparisonInterface
{
    const NAME = "between";

    /**
     * @return \Closure[]
     */
    function getAllComparisons()
    {
        return array(
            self::NAME => function ($a, $min, $max) {
                    return $min <= $a && $max >= $a;
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
