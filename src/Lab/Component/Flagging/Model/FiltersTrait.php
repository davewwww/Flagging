<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
trait FiltersTrait {

    /**
     * @var null|FilterCollectionInterface[]
     */
    protected $filters;

    /**
     * @return null|FilterCollectionInterface[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param null|FilterCollectionInterface[] $filters
     */
    public function setFilters(array $filters = null)
    {
        $this->filters = $filters;
    }

    /**
     * @param FilterCollectionInterface $filter
     */
    public function addFilter(FilterCollectionInterface $filter)
    {
        $this->filters[] = $filter;
    }
}