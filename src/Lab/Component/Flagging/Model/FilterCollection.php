<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FilterCollection implements FilterCollectionInterface
{
    /**
     * @var FilterInterface[]
     */
    protected $filter;

    /**
     * @param FilterInterface[] $filter
     */
    function __construct(array $filter = null)
    {
        $this->filter = $filter;
    }

    /**
     * @return FilterInterface[]
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filter[] = $filter;
    }
}