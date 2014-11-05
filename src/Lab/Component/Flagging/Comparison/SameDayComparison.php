<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class SameDayComparison implements ComparisonInterface
{
    const NAME = "sameday";

    /**
     * @return \Closure[]
     */
    function getAllComparisons()
    {
        return array(
            self::NAME => function ($a, $b) {
                    if ($a instanceof \DateTime) {
                        $a = $a->format("Y-m-d");
                    }
                    if ($b instanceof \DateTime) {
                        $b = $b->format("Y-m-d");
                    }

                    return $a === $b;
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
