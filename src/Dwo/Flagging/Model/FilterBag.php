<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
 */
class FilterBag implements FilterBagInterface
{
    /**
     * @var FilterGroupInterface[]
     */
    protected $filterGroups;

    /**
     * @param FilterGroupInterface[] $filterGroups
     */
    public function __construct(array $filterGroups = array())
    {
        $this->filterGroups = $filterGroups;
    }

    /**
     * @return FilterGroupInterface[]
     */
    public function getFilterGroups()
    {
        return $this->filterGroups;
    }

    /**
     * @return bool
     */
    public function hasFilter()
    {
        return (bool) count($this->filterGroups);
    }
}