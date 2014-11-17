<?php

namespace Lab\Component\Flagging\Context;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ResultCache
{
    /**
     * @var array
     */
    protected $results;

    /**
     * @param string $id
     *
     * @return Boolean|null
     */
    function getResult($id)
    {
        return isset($this->results[$id]) ? $this->results[$id] : null;
    }

    /**
     * @param string  $id
     * @param Boolean $result
     */
    function addResult($id, $result)
    {
        $this->results[$id] = $result;
    }
}
