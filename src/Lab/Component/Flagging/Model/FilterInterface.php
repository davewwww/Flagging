<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface FilterInterface
{
    /**
     * @return string
     */
    function getName();

    /**
     * @param string $name
     */
    function setName($name);

    /**
     * @return array
     */
    function getParameter();

    /**
     * @param mixed $parameters
     */
    function setParameter($parameters);
}