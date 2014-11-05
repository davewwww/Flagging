<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ContainerComparison implements ComparisonInterface
{
    /**
     * @var \Closure[]
     */
    protected $comperions;

    /**
     * @param \Closure[] $comperions
     */
    function __construct(array $comperions)
    {
        $this->comperions = $comperions;
    }

    /**
     * @param string     $key
     * @param \Closure[] $comperion
     */
    public function addComperion($key, $comperion)
    {
        $this->comperions[$key] = $comperion;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllComparisons()
    {
        return $this->comperions;
    }

    /**
     * {@inheritDoc}
     */
    public function getComparison($key)
    {
        return $this->comperions[$key];
    }
}
