<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface ValueInterface
{
    /**
     * @return FilterInterface[]
     */
    function getFilters();

    /**
     * @return mixed
     */
    function getValue();
}