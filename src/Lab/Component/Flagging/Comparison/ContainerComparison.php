<?php

namespace Lab\Component\Flagging\Comparison;

use Lab\Component\Flagging\Exception\FlaggingException;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ContainerComparison implements ComparisonInterface
{
    /**
     * @var \Closure[]
     */
    protected $comparisons;

    /**
     * @param \Closure[] $comparisons
     */
    function __construct(array $comparisons)
    {
        $this->comparisons = $comparisons;
    }

    /**
     * @param string   $key
     * @param \Closure $comparison
     */
    public function addComparison($key, $comparison)
    {
        $this->comparisons[$key] = $comparison;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllComparisons()
    {
        return $this->comparisons;
    }

    /**
     * {@inheritDoc}
     */
    public function getComparison($key = null)
    {
        if (empty($key) || !isset($this->comparisons[$key])) {
            throw new FlaggingException(sprintf("unknown comparison %s", $key));
        }

        return $this->comparisons[$key];
    }
}
