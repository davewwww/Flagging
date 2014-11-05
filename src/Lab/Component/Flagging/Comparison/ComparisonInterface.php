<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface ComparisonInterface
{
    /**
     * @param string $key
     *
     * @return \Closure
     */
    function getComparison($key);

    /**
     * @return \Closure[]
     */
    function getAllComparisons();
}
