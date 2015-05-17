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
     * @param FilterGroupInterface $filterGroup
     */
    public function addFilterGroup(FilterGroupInterface $filterGroup);

    /**
     * @return bool
     */
    public function hasFilter();
}