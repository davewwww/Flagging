<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
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