<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
class FilterGroup implements FilterGroupInterface
{
    /**
     * @var FilterInterface[]
     */
    protected $filters;

    /**
     * @param FilterInterface[] $filters
     */
    public function __construct(array $filters = array())
    {
        $this->filters = $filters;
    }

    /**
     * @return FilterInterface[]
     */
    public function getFilters()
    {
        return $this->filters;
    }
}