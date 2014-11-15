<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ModulousComparison implements ComparisonInterface
{
    const NAME = "modulous";

    /**
     * {@inheritDoc}
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
    function getComparison($key = null)
    {
        return $this->getAllComparisons()[self::NAME];
    }
}
