<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
 */
interface FilterGroupInterface
{
    /**
     * @return FilterInterface[]
     */
    public function getFilters();
}