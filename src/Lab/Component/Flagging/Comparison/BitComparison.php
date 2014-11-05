<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class BitComparison implements ComparisonInterface
{
    const NAME = "bit";

    /**
     * @return \Closure[]
     */
    function getAllComparisons()
    {
        return array(
            self::NAME => function ($a, $b) {
                    return 0 !== ((int)$a & (int)$b);
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
