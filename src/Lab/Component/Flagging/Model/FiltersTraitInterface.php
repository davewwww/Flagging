<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface FiltersTraitInterface {

    /**
     * @return null|FilterCollectionInterface[]
     */
    public function getFilters();

    /**
     * @param null|FilterCollectionInterface[] $filters
     */
    public function setFilters(array $filters = null);

    /**
     * @param FilterCollectionInterface $filter
     */
    public function addFilter(FilterCollectionInterface $filter);
}