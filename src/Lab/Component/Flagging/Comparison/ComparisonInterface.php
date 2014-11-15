<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface ComparisonInterface
{
    /**
     * @param string|null $key
     *
     * @return \Closure
     */
    function getComparison($key = null);

    /**
     * @return \Closure[]
     */
    function getAllComparisons();
}
