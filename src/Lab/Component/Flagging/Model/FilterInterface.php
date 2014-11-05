<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface FilterInterface
{
    /**
     * @return array
     */
    function getName();

    /**
     * @return array
     */
    function getParameter();
}