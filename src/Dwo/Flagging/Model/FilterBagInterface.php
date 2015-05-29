<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface FilterBagInterface
{
    /**
     * @return FilterGroupInterface[]
     */
    public function getFilterGroups();

    /**
     * @return bool
     */
    public function hasFilter();
}