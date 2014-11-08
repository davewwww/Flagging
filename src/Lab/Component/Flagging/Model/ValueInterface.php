<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface ValueInterface
{
    /**
     * @return array
     */
    function getFilters();

    /**
     * @return mixed
     */
    function getValue();
}