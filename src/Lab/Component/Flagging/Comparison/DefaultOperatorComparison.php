<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class DefaultOperatorComparison implements ComparisonInterface
{
    /**
     * @return \Closure[]
     */
    function getAllComparisons()
    {
        return array(
            '==' => function ($a, $b) {
                    return $a == $b;
                },
            '!=' => function ($a, $b) {
                    return $a != $b;
                },
            '<'  => function ($a, $b) {
                    return $a < $b;
                },
            '<=' => function ($a, $b) {
                    return $a <= $b;
                },
            '>=' => function ($a, $b) {
                    return $a >= $b;
                },
            '>'  => function ($a, $b) {
                    return $a > $b;
                }
        );
    }

    /**
     * {@inheritDoc}
     */
    function getComparison($key)
    {
        return $this->getAllComparisons()[$key];
    }
}
