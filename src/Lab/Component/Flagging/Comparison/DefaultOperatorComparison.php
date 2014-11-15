<?php

namespace Lab\Component\Flagging\Comparison;

use Lab\Component\Flagging\Exception\FlaggingException;

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
    function getComparison($key = null)
    {
        $closures = $this->getAllComparisons();

        if (!isset($closures[$key])) {
            throw new FlaggingException(sprintf("unknown operator %s in %s", $key, __CLASS__));
        }

        return $closures[$key];
    }
}
