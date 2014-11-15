<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface FilterCollectionInterface
{
    /**
     * @return FilterInterface[]
     */
    public function getFilter();
}