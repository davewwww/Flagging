<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface FilterGroupInterface
{
    /**
     * @return FilterInterface[]
     */
    public function getFilters();
}