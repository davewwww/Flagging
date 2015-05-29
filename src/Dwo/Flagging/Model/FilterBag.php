<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
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